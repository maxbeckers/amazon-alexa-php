<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Helper;

use MaxBeckers\AmazonAlexa\Exception\InvalidSsmlException;

class SsmlGenerator implements SsmlTypes
{
    /**
     * Enable this flag, when you need escaped special chars in your content (for example escaped "&").
     */
    public bool $escapeSpecialChars = false;

    /** @var string[] */
    private array $parts = [];

    /**
     * Clear the current ssml parts.
     */
    public function clear(): void
    {
        $this->parts = [];
    }

    public function getSsml(): string
    {
        return sprintf('<speak>%s</speak>', implode(' ', $this->parts));
    }

    /**
     * Say a default text.
     */
    public function say(string $text): void
    {
        $this->parts[] = $this->textEscapeSpecialChars($text);
    }

    /**
     * Play audio in output.
     * For more specifications of the mp3 file @see https://developer.amazon.com/de/docs/custom-skills/speech-synthesis-markup-language-ssml-reference.html#audio.
     *
     * @throws InvalidSsmlException
     */
    public function playMp3(string $mp3Url): void
    {
        if (1 !== preg_match('/^(https:\/\/.*\.mp3.*)$/i', $mp3Url) && 0 !== strpos($mp3Url, 'soundbank://')) {
            throw new InvalidSsmlException(sprintf('"%s" in not a valid mp3 url!', $mp3Url));
        }
        $this->parts[] = sprintf('<audio src="%s" />', $mp3Url);
    }

    /**
     * Make a pause (or remove with none/x-weak).
     * Possible values @see https://developer.amazon.com/de/docs/custom-skills/speech-synthesis-markup-language-ssml-reference.html#break.
     *
     * @throws InvalidSsmlException
     */
    public function pauseStrength(string $strength): void
    {
        if (!in_array($strength, self::BREAK_STRENGTHS, true)) {
            throw new InvalidSsmlException(sprintf('Break strength must be one of "%s"!', implode(',', self::BREAK_STRENGTHS)));
        }
        $this->parts[] = sprintf('<break strength="%s" />', $strength);
    }

    /**
     * Make a pause with duration time as string in seconds(s) or milliseconds(ms).
     * For example '10s' or '10000ms' to break 10 seconds.
     *
     * @throws InvalidSsmlException
     */
    public function pauseTime(string $time): void
    {
        if (1 !== preg_match('/^(\d+(s|ms))$/i', $time)) {
            throw new InvalidSsmlException('Time must be seconds or milliseconds!');
        }
        $this->parts[] = sprintf('<break time="%s" />', $time);
    }

    /**
     * Say a text with effect.
     *
     * @throws InvalidSsmlException
     */
    public function sayWithAmazonEffect(string $text, string $effect = self::AMAZON_EFFECT_WHISPERED): void
    {
        if (!in_array($effect, self::AMAZON_EFFECTS, true)) {
            throw new InvalidSsmlException(sprintf('Amazon:effect name must be one of "%s"!', implode(',', self::AMAZON_EFFECTS)));
        }
        $this->parts[] = sprintf('<amazon:effect name="%s">%s</amazon:effect>', $effect, $this->textEscapeSpecialChars($text));
    }

    /**
     * Whisper a text.
     */
    public function whisper(string $text): void
    {
        $this->sayWithAmazonEffect($text, self::AMAZON_EFFECT_WHISPERED);
    }

    /**
     * Say with emphasis.
     *
     * @throws InvalidSsmlException
     */
    public function emphasis(string $text, string $level): void
    {
        if (!in_array($level, self::EMPHASIS_LEVELS, true)) {
            throw new InvalidSsmlException(sprintf('Emphasis level must be one of "%s"!', implode(',', self::EMPHASIS_LEVELS)));
        }
        $this->parts[] = sprintf('<emphasis level="%s">%s</emphasis>', $level, $this->textEscapeSpecialChars($text));
    }

    /**
     * Say a text pronounced in the given language.
     *
     * @throws InvalidSsmlException
     */
    public function pronounceInLanguage(string $language, string $text): void
    {
        if (!in_array($language, self::LANGUAGE_LIST, true)) {
            throw new InvalidSsmlException(sprintf('Language must be one of "%s"!', implode(',', self::LANGUAGE_LIST)));
        }
        $this->parts[] = sprintf('<lang xml:lang="%s">%s</lang>', $language, $this->textEscapeSpecialChars($text));
    }

    /**
     * Say a paragraph.
     */
    public function paragraph(string $paragraph): void
    {
        $this->parts[] = sprintf('<p>%s</p>', $this->textEscapeSpecialChars($paragraph));
    }

    /**
     * Say a text with a phoneme.
     *
     * @throws InvalidSsmlException
     */
    public function phoneme(string $alphabet, string $ph, string $text): void
    {
        if (!in_array($alphabet, self::PHONEME_ALPHABETS, true)) {
            throw new InvalidSsmlException(sprintf('Phoneme alphabet must be one of "%s"!', implode(',', self::PHONEME_ALPHABETS)));
        }
        $this->parts[] = sprintf('<phoneme alphabet="%s" ph="%s">%s</phoneme>', $alphabet, $ph, $this->textEscapeSpecialChars($text));
    }

    /**
     * Say a text with a prosody.
     *
     * There are three different modes of prosody: volume, pitch, and rate.
     * For more details @see https://developer.amazon.com/de/docs/custom-skills/speech-synthesis-markup-language-ssml-reference.html#prosody
     *
     * @throws InvalidSsmlException
     */
    public function prosody(string $mode, string $value, string $text): void
    {
        if (!isset(self::PROSODIES[$mode])) {
            throw new InvalidSsmlException(sprintf('Prosody mode must be one of "%s"!', implode(',', array_keys(self::PROSODIES))));
        }
        // todo validate value for mode
        $this->parts[] = sprintf('<prosody %s="%s">%s</prosody>', $mode, $value, $this->textEscapeSpecialChars($text));
    }

    /**
     * Say a sentence.
     */
    public function sentence(string $text): void
    {
        $this->parts[] = sprintf('<s>%s</s>', $this->textEscapeSpecialChars($text));
    }

    /**
     * Say a text with interpretation.
     *
     * @throws InvalidSsmlException
     */
    public function sayAs(string $interpretAs, string $text, string $format = ''): void
    {
        if (!in_array($interpretAs, self::SAY_AS_INTERPRET_AS, true)) {
            throw new InvalidSsmlException(sprintf('Interpret as attribute must be one of "%s"!', implode(',', self::SAY_AS_INTERPRET_AS)));
        }
        if ($format) {
            $this->parts[] = sprintf('<say-as interpret-as="%s" format="%s">%s</say-as>', $interpretAs, $format, $this->textEscapeSpecialChars($text));
        } else {
            $this->parts[] = sprintf('<say-as interpret-as="%s">%s</say-as>', $interpretAs, $this->textEscapeSpecialChars($text));
        }
    }

    /**
     * Say an alias.
     * For example replace the abbreviated chemical elements with the full words.
     */
    public function alias(string $alias, string $text): void
    {
        $this->parts[] = sprintf('<sub alias="%s">%s</sub>', $alias, $this->textEscapeSpecialChars($text));
    }

    /**
     * Say a text with the voice of the given person.
     *
     * @throws InvalidSsmlException
     */
    public function sayWithVoice(string $voice, string $text): void
    {
        if (!in_array($voice, self::VOICES, true)) {
            throw new InvalidSsmlException(sprintf('Voice must be one of "%s"!', implode(',', self::VOICES)));
        }
        $this->parts[] = sprintf('<voice name="%s">%s</voice>', $voice, $this->textEscapeSpecialChars($text));
    }

    /**
     * Say a word with defined word's parts to speach.
     *
     * @throws InvalidSsmlException
     */
    public function word(string $role, string $text): void
    {
        if (!in_array($role, self::INTERPRET_WORDS, true)) {
            throw new InvalidSsmlException(sprintf('Interpret as attribute must be one of "%s"!', implode(',', self::INTERPRET_WORDS)));
        }
        $this->parts[] = sprintf('<w role="%s">%s</w>', $role, $this->textEscapeSpecialChars($text));
    }

    /**
     * Escape special chars for ssml output (for example "&").
     */
    private function textEscapeSpecialChars(string $text): string
    {
        if ($this->escapeSpecialChars) {
            $text = htmlspecialchars($text);
        }

        return $text;
    }
}
