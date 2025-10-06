<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\Component;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\APLComponentType;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\AudioTrack;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\Scale;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand\AbstractStandardCommand;

class VideoComponent extends APLBaseComponent implements \JsonSerializable
{
    public const TYPE = APLComponentType::VIDEO;

    /**
     * @param AudioTrack|null $audioTrack Audio track to play on
     * @param bool $autoplay If true, automatically start playing the video
     * @param bool $muted When true, mute the audio for the video
     * @param AbstractStandardCommand[]|null $onEnd Commands to run when the last video track is finished playing
     * @param AbstractStandardCommand[]|null $onPause Commands to run when the video switches from playing to paused
     * @param AbstractStandardCommand[]|null $onPlay Commands to run when the video switches from paused to playing
     * @param AbstractStandardCommand[]|null $onTimeUpdate Commands to run when the playback position changes
     * @param AbstractStandardCommand[]|null $onTrackUpdate Commands to run when the current video track changes
     * @param AbstractStandardCommand[]|null $onTrackReady Commands to run when the current track state changes to ready
     * @param AbstractStandardCommand[]|null $onTrackFail Commands to run when an error occurs and video player can't play the media
     * @param string[]|null $preserve Properties to save when reinflating the document
     * @param Scale|null $scale How the video should scale to fill the space
     * @param bool $screenLock When true, extend the document lifecycle when the video is playing
     * @param string|array|null $source Single video source URL
     * @param array|null $sources Array of video sources
     * @param string[]|null $trackChanges Properties to track and report changes in the visual context
     */
    public function __construct(
        public ?AudioTrack $audioTrack = null,
        public bool $autoplay = false,
        public bool $muted = false,
        public ?array $onEnd = null,
        public ?array $onPause = null,
        public ?array $onPlay = null,
        public ?array $onTimeUpdate = null,
        public ?array $onTrackUpdate = null,
        public ?array $onTrackReady = null,
        public ?array $onTrackFail = null,
        ?array $preserve = null,
        public ?Scale $scale = null,
        public bool $screenLock = true,
        public string|array|null $source = null,
        public ?array $sources = null,
        ?array $trackChanges = null,
    ) {
        parent::__construct(type: self::TYPE, preserve: $preserve, trackChanges: $trackChanges);
    }

    public function jsonSerialize(): array
    {
        $data = parent::jsonSerialize();

        $this->addEnum($data, 'audioTrack', $this->audioTrack);
        $this->addBooleanTrue($data, 'autoplay', $this->autoplay);
        $this->addBooleanTrue($data, 'muted', $this->muted);

        $this->addCommandArray($data, 'onEnd', $this->onEnd);
        $this->addCommandArray($data, 'onPause', $this->onPause);
        $this->addCommandArray($data, 'onPlay', $this->onPlay);
        $this->addCommandArray($data, 'onTimeUpdate', $this->onTimeUpdate);
        $this->addCommandArray($data, 'onTrackUpdate', $this->onTrackUpdate);
        $this->addCommandArray($data, 'onTrackReady', $this->onTrackReady);
        $this->addCommandArray($data, 'onTrackFail', $this->onTrackFail);

        $this->addNonEmptyArray($data, 'preserve', $this->preserve);
        $this->addEnum($data, 'scale', $this->scale);

        // screenLock only included when false (default true)
        if (!$this->screenLock) {
            $data['screenLock'] = false;
        }

        if ($this->source !== null) {
            $data['source'] = $this->source;
        }

        $this->addNonEmptyArray($data, 'sources', $this->sources);
        $this->addNonEmptyArray($data, 'trackChanges', $this->trackChanges);

        return $data;
    }

    /**
     * @param array<string,mixed> $data
     */
    private function addEnum(array &$data, string $key, ?\UnitEnum $enum): void
    {
        if ($enum !== null) {
            $data[$key] = $enum->value;
        }
    }

    /**
     * @param array<string,mixed> $data
     * @param AbstractStandardCommand[]|null $commands
     */
    private function addCommandArray(array &$data, string $key, ?array $commands): void
    {
        if ($commands !== null && $commands !== []) {
            $data[$key] = $commands;
        }
    }

    /**
     * @param array<string,mixed> $data
     * @param array<mixed>|null $arr
     */
    private function addNonEmptyArray(array &$data, string $key, ?array $arr): void
    {
        if ($arr !== null && $arr !== []) {
            $data[$key] = $arr;
        }
    }

    /**
     * @param array<string,mixed> $data
     */
    private function addBooleanTrue(array &$data, string $key, bool $value): void
    {
        if ($value) {
            $data[$key] = true;
        }
    }
}
