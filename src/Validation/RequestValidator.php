<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Validation;

use GuzzleHttp\Client;
use MaxBeckers\AmazonAlexa\Exception\OutdatedCertExceptionException;
use MaxBeckers\AmazonAlexa\Exception\RequestInvalidSignatureException;
use MaxBeckers\AmazonAlexa\Exception\RequestInvalidTimestampException;
use MaxBeckers\AmazonAlexa\Request\Request;

/**
 * This is a validator for amazon echo requests. It validates the timestamp of the request and the request signature.
 */
class RequestValidator
{
    /**
     * Basic value for timestamp validation. 150 seconds is suggested by amazon.
     */
    public const TIMESTAMP_VALID_TOLERANCE_SECONDS = 150;

    /**
     * @param int $timestampTolerance Timestamp tolerance in seconds
     * @param Client $client HTTP client for fetching certificates
     */
    public function __construct(
        protected int $timestampTolerance = self::TIMESTAMP_VALID_TOLERANCE_SECONDS,
        public Client $client = new Client(),
    ) {
    }

    /**
     * Validate request data.
     *
     * @throws OutdatedCertExceptionException
     * @throws RequestInvalidSignatureException
     * @throws RequestInvalidTimestampException
     */
    public function validate(Request $request): void
    {
        $this->validateTimestamp($request);
        try {
            $this->validateSignature($request);
        } catch (OutdatedCertExceptionException $e) {
            // load cert again and validate because temp file was outdated.
            $this->validateSignature($request);
        }
    }

    /**
     * Validate request timestamp. Request tolerance should be 150 seconds.
     * For more details @see https://developer.amazon.com/public/solutions/alexa/alexa-skills-kit/docs/developing-an-alexa-skill-as-a-web-service#timestamp.
     *
     * @throws RequestInvalidTimestampException
     */
    private function validateTimestamp(Request $request): void
    {
        if (null === $request->request || !$request->request->validateTimestamp()) {
            return;
        }

        $differenceInSeconds = time() - $request->request->timestamp->getTimestamp();

        if ($differenceInSeconds > $this->timestampTolerance) {
            throw new RequestInvalidTimestampException('Invalid timestamp.');
        }
    }

    /**
     * Validate request signature. The steps for signature validation are described at developer page.
     *
     * @see https://developer.amazon.com/public/solutions/alexa/alexa-skills-kit/docs/developing-an-alexa-skill-as-a-web-service#checking-the-signature-of-the-request
     *
     * @throws OutdatedCertExceptionException
     * @throws RequestInvalidSignatureException
     */
    private function validateSignature(Request $request): void
    {
        if (null === $request->request || !$request->request->validateSignature()) {
            return;
        }

        // validate cert url
        $this->validateCertUrl($request);

        // generate local cert path
        $localCertPath = sys_get_temp_dir() . DIRECTORY_SEPARATOR . md5($request->signatureCertChainUrl) . '.pem';

        // check if pem file is already downloaded to temp or download.
        $certData = $this->fetchCertData($request, $localCertPath);

        // openssl cert validation
        $this->verifyCert($request, $certData);

        // parse cert
        $certContent = $this->parseCertData($certData);

        // validate cert
        $this->validateCertContent($certContent, $localCertPath);
    }

    /**
     * @throws RequestInvalidSignatureException
     */
    private function validateCertUrl(Request $request): void
    {
        if (false === (bool) preg_match("/https:\/\/s3.amazonaws.com(\:443)?\/echo.api\/*/i", $request->signatureCertChainUrl)) {
            throw new RequestInvalidSignatureException('Invalid cert url.');
        }
    }

    /**
     * @throws RequestInvalidSignatureException
     */
    private function fetchCertData(Request $request, string $localCertPath): string
    {
        if (!file_exists($localCertPath)) {
            $response = $this->client->request('GET', $request->signatureCertChainUrl);

            if ($response->getStatusCode() !== 200) {
                throw new RequestInvalidSignatureException('Can\'t fetch cert from URL.');
            }

            $certData = $response->getBody()->getContents();
            @file_put_contents($localCertPath, $certData);
        } else {
            $certData = @file_get_contents($localCertPath);
        }

        return $certData;
    }

    /**
     * @throws RequestInvalidSignatureException
     */
    private function verifyCert(Request $request, string $certData): void
    {
        if (1 !== @openssl_verify($request->amazonRequestBody, base64_decode($request->signature, true), $certData, 'sha1')) {
            throw new RequestInvalidSignatureException('Cert ssl verification failed.');
        }
    }

    /**
     * @throws RequestInvalidSignatureException
     */
    private function parseCertData(string $certData): array
    {
        $certContent = @openssl_x509_parse($certData);
        if (empty($certContent)) {
            throw new RequestInvalidSignatureException('Parse cert failed.');
        }

        return $certContent;
    }

    /**
     * @throws OutdatedCertExceptionException
     * @throws RequestInvalidSignatureException
     */
    private function validateCertContent(array $cert, string $localCertPath): void
    {
        $this->validateCertSubject($cert);
        $this->validateCertValidTime($cert, $localCertPath);
    }

    /**
     * @throws RequestInvalidSignatureException
     */
    private function validateCertSubject(array $cert): void
    {
        if (false === isset($cert['extensions']['subjectAltName']) ||
            false === stristr($cert['extensions']['subjectAltName'], 'echo-api.amazon.com')
        ) {
            throw new RequestInvalidSignatureException('Cert subject error.');
        }
    }

    /**
     * @throws OutdatedCertExceptionException
     */
    private function validateCertValidTime(array $cert, string $localCertPath): void
    {
        if (false === isset($cert['validTo_time_t']) || time() > $cert['validTo_time_t'] || false === isset($cert['validFrom_time_t']) || time() < $cert['validFrom_time_t']) {
            if (file_exists($localCertPath)) {
                /* @scrutinizer ignore-unhandled */ @unlink($localCertPath);
            }
            throw new OutdatedCertExceptionException('Cert is outdated.');
        }
    }
}
