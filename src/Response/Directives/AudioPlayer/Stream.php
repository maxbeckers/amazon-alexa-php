<?php

namespace MaxBeckers\AmazonAlexa\Response\Directives\AudioPlayer;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class Stream implements \JsonSerializable
{
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
        $data = [
            'url'   => $this->url,
            'token' => $this->token,
        ];

        if (null !== $this->expectedPreviousToken) {
            $data['expectedPreviousToken'] = $this->expectedPreviousToken;
        }
        if (null !== $this->offsetInMilliseconds) {
            $data['offsetInMilliseconds'] = $this->offsetInMilliseconds;
        }

        return $data;
    }
}
