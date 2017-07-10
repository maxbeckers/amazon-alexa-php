<?php

namespace MaxBeckers\AmazonAlexa\Validation;

use MaxBeckers\AmazonAlexa\Exception\RequestInvalidException;
use MaxBeckers\AmazonAlexa\Request\Request;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class RequestValidator
{
    const TIMESTAMP_VALID_TOLERANCE_SECONDS = 150;

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
     * For more details @see https://developer.amazon.com/public/solutions/alexa/alexa-skills-kit/docs/developing-an-alexa-skill-as-a-web-service#timestamp
     *
     * @param Request $request
     *
     * @throws RequestInvalidException
     */
    private function validateTimestamp(Request $request)
    {
        if (!$request->request->validateTimestamp()) {
            return;
        }

        $differenceInSeconds = time() - $request->request->timestamp->getTimestamp();

        if ($differenceInSeconds > self::TIMESTAMP_VALID_TOLERANCE_SECONDS) {
            throw new RequestInvalidException('Invalid timestamp.');
        }
    }

    /**
     * Validate request signature. The steps for signature validation are described at developer page.
     * @see https://developer.amazon.com/public/solutions/alexa/alexa-skills-kit/docs/developing-an-alexa-skill-as-a-web-service#checking-the-signature-of-the-request
     *
     * @param Request $request
     *
     * @throws RequestInvalidException
     */
    private function validateSignature(Request $request)
    {
        if (!$request->request->validateSignature()) {
            return;
        }

        $signatureCertChainUrl = $request->amazonRequestHeaders['HTTP_SIGNATURECERTCHAINURL'];
        $signature             = $request->amazonRequestHeaders['HTTP_SIGNATURE'];

        // validate cert url
        if (false === preg_match("/https:\/\/s3.amazonaws.com(\:443)?\/echo.api\/*/i", $signatureCertChainUrl)) {
            throw new RequestInvalidException('Invalid cert url.');
        }

        // check if pem file is already downloaded to temp or download.
        $localCertPath = sys_get_temp_dir().'/'.md5($signatureCertChainUrl).".pem";
        if (!file_exists($localCertPath)) {
            $certData = file_get_contents($signatureCertChainUrl);
            file_put_contents($localCertPath, $certData);
        } else {
            $certData = file_get_contents($localCertPath);
        }

        // openssl cert validation
        if (1 !== openssl_verify($request->amazonRequestBody, base64_decode($signature), $certData)) {
            throw new RequestInvalidException('Cert ssl verification failed.');
        }

        // parse cert
        $cert = openssl_x509_parse($certData);
        if (empty($cert)) {
            throw new RequestInvalidException('Parse cert failed.');
        }

        // validate cert subject
        if (false === isset($cert['extensions']['subjectAltName']) ||
            true !== stristr($cert['extensions']['subjectAltName'], 'echo-api.amazon.com')
        ) {
            throw new RequestInvalidException('Cert subject error.');
        }

        // validate cert validTo time
        if (false === isset($cert['validTo_time_t']) || time() > $cert['validTo_time_t']) {
            if (file_exists($localCertPath)) {
                unlink($localCertPath);
            }
            throw new RequestInvalidException('Cert is outdated.');
        }
    }
}
