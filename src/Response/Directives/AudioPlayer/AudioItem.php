<?php

namespace MaxBeckers\AmazonAlexa\Response\Directives\AudioPlayer;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class AudioItem
{
    /**
     * @var Stream
     */
    public $stream;

    /**
     * @param Stream $steam
     *
     * @return AudioItem
     */
    public static function create(Stream $steam): self
    {
        $audioItem = new self();

        $audioItem->stream = $steam;

        return $audioItem;
    }
}
