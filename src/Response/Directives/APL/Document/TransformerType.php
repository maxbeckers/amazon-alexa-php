<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\Document;

enum TransformerType: string
{
    case SSML_TO_SPEECH = 'ssmlToSpeech';
    case TEXT_TO_SPEECH = 'textToSpeech';
    case APL_AUDIO_TO_SPEECH = 'aplAudioToSpeech';
}
