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

        if ($this->audioTrack !== null) {
            $data['audioTrack'] = $this->audioTrack->value;
        }

        if ($this->autoplay) {
            $data['autoplay'] = $this->autoplay;
        }

        if ($this->muted) {
            $data['muted'] = $this->muted;
        }

        if ($this->onEnd !== null && !empty($this->onEnd)) {
            $data['onEnd'] = $this->onEnd;
        }

        if ($this->onPause !== null && !empty($this->onPause)) {
            $data['onPause'] = $this->onPause;
        }

        if ($this->onPlay !== null && !empty($this->onPlay)) {
            $data['onPlay'] = $this->onPlay;
        }

        if ($this->onTimeUpdate !== null && !empty($this->onTimeUpdate)) {
            $data['onTimeUpdate'] = $this->onTimeUpdate;
        }

        if ($this->onTrackUpdate !== null && !empty($this->onTrackUpdate)) {
            $data['onTrackUpdate'] = $this->onTrackUpdate;
        }

        if ($this->onTrackReady !== null && !empty($this->onTrackReady)) {
            $data['onTrackReady'] = $this->onTrackReady;
        }

        if ($this->onTrackFail !== null && !empty($this->onTrackFail)) {
            $data['onTrackFail'] = $this->onTrackFail;
        }

        if ($this->preserve !== null && !empty($this->preserve)) {
            $data['preserve'] = $this->preserve;
        }

        if ($this->scale !== null) {
            $data['scale'] = $this->scale->value;
        }

        if (!$this->screenLock) {
            $data['screenLock'] = $this->screenLock;
        }

        if ($this->source !== null) {
            $data['source'] = $this->source;
        }

        if ($this->sources !== null && !empty($this->sources)) {
            $data['sources'] = $this->sources;
        }

        if ($this->trackChanges !== null && !empty($this->trackChanges)) {
            $data['trackChanges'] = $this->trackChanges;
        }

        return $data;
    }
}
