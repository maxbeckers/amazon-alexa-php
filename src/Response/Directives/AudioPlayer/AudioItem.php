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

    public static function create(Stream $steam)
    {
        $audioItem = new self();

        $audioItem->stream = $steam;

        return $audioItem;
    }
}
