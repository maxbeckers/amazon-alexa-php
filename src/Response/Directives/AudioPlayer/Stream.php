<?php

namespace MaxBeckers\AmazonAlexa\Response\Directives\AudioPlayer;

use MaxBeckers\AmazonAlexa\Helper\SerializeValueMapper;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class Stream implements \JsonSerializable
{
    use SerializeValueMapper;

    /**
     * @var string
     */
    public $url;

    /**
     * @var string
     */
    public $token;

    /**
     * @var string|null
     */
    public $expectedPreviousToken;

    /**
     * @var int|null
     */
    public $offsetInMilliseconds;

    /**
     * @param string      $url
     * @param string      $token
     * @param null|string $expectedPreviousToken
     * @param int|null    $offsetInMilliseconds
     *
     * @return Stream
     */
    public static function create(string $url, string $token, string $expectedPreviousToken = null, int $offsetInMilliseconds = null): self
    {
        $stream = new self();

        $stream->url                   = $url;
        $stream->token                 = $token;
        $stream->expectedPreviousToken = $expectedPreviousToken;
        $stream->offsetInMilliseconds  = $offsetInMilliseconds;

        return $stream;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        $data = new \ArrayObject([
            'url'   => $this->url,
            'token' => $this->token,
        ]);

        $this->valueToArrayIfSet($data, 'expectedPreviousToken');
        $this->valueToArrayIfSet($data, 'offsetInMilliseconds');

        return $data;
    }
}
