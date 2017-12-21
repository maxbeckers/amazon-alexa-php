<?php

namespace MaxBeckers\AmazonAlexa\Validation;

use MaxBeckers\AmazonAlexa\Exception\RequestInvalidSignatureException;
use MaxBeckers\AmazonAlexa\Exception\RequestInvalidTimestampException;
use MaxBeckers\AmazonAlexa\Request\Request;

/**
 * This is a validator for amazon echo requests. It validates the timestamp of the request and the request signature.
 *
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class RequestValidator
{
    /**
     * Default value for timestamp validation. 150 seconds is suggested by amazon.
     */
    const TIMESTAMP_VALID_TOLERANCE_SECONDS = 150;

    /**
     * @var int
     */
    protected $timestampTolerance;

    /**
     * @param int $timestampTolerance
     */
    public function __construct($timestampTolerance = self::TIMESTAMP_VALID_TOLERANCE_SECONDS)
    {
        $this->timestampTolerance = $timestampTolerance;
    }

    /**
     * Validate request data.
     *
     * @param Request $request
     */
    public function validate(Request $request)
    {
        $this->validateTimestamp($request);
        $this->validateSignature($request);
    }

    /**
     * Validate request timestamp. Request tolerance should be 150 seconds.
     * For more details @see https://developer.amazon.com/public/solutions/alexa/alexa-skills-kit/docs/developing-an-alexa-skill-as-a-web-service#timestamp.
     *
     * @param Request $request
     *
     * @throws RequestInvalidTimestampException
     */
    private function validateTimestamp(Request $request)
    {
        if (!$request->request->validateTimestamp()) {
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
     * @param Request $request
     *
     * @throws RequestInvalidSignatureException
     */
    private function validateSignature(Request $request)
    {
        if (!$request->request->validateSignature()) {
            return;
        }

        // validate cert url
        if (false === (bool) preg_match("/https:\/\/s3.amazonaws.com(\:443)?\/echo.api\/*/i", $request->signatureCertChainUrl)) {
            throw new RequestInvalidSignatureException('Invalid cert url.');
        }

        // check if pem file is already downloaded to temp or download.
        $localCertPath = sys_get_temp_dir().DIRECTORY_SEPARATOR.md5($request->signatureCertChainUrl).'.pem';
        if (!file_exists($localCertPath)) {
            $certData = @file_get_contents($request->signatureCertChainUrl);
            @file_put_contents($localCertPath, $certData);
        } else {
            $certData = @file_get_contents($localCertPath);
        }

        // openssl cert validation
        if (1 !== @openssl_verify($request->amazonRequestBody, base64_decode($request->signature, true), $certData, 'sha1')) {
            throw new RequestInvalidSignatureException('Cert ssl verification failed.');
        }

        // parse cert
        $cert = @openssl_x509_parse($certData);
        if (empty($cert)) {
            throw new RequestInvalidSignatureException('Parse cert failed.');
        }

        // validate cert subject
        if (false === isset($cert['extensions']['subjectAltName']) ||
            false === stristr($cert['extensions']['subjectAltName'], 'echo-api.amazon.com')
        ) {
            throw new RequestInvalidSignatureException('Cert subject error.');
        }

        // validate cert validTo time
        if (false === isset($cert['validTo_time_t']) || time() > $cert['validTo_time_t'] || false === isset($cert['validFrom_time_t']) || time() < $cert['validFrom_time_t']) {
            if (file_exists($localCertPath)) {
                @unlink($localCertPath);
            }
            throw new RequestInvalidSignatureException('Cert is outdated.');
        }
    }
}
