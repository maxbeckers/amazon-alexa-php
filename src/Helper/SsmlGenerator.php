<?php

namespace MaxBeckers\AmazonAlexa\Helper;

use MaxBeckers\AmazonAlexa\Exception\InvalidSsmlException;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class SsmlGenerator implements SsmlTypes
{
    /**
     * @var string[]
     */
    private $parts = [];

    /**
     * Clear the current ssml parts.
     */
    public function clear()
    {
        $this->parts = [];
    }

    /**
     * @return string
     */
    public function getSsml()
    {
        return sprintf('<speak>%s</speak>', implode(' ', $this->parts));
    }

    /**
     * Say a default text.
     *
     * @param string $text
     */
    public function say(string $text)
    {
        $this->parts[] = $text;
    }

    /**
     * Play audio in output.
     * For more specifications of the mp3 file @see https://developer.amazon.com/de/docs/custom-skills/speech-synthesis-markup-language-ssml-reference.html#audio.
     *
     * @param string $mp3Url
     *
     * @throws InvalidSsmlException
     */
    public function playMp3(string $mp3Url)
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
     * @param string $strength
     *
     * @throws InvalidSsmlException
     */
    public function pauseStrength(string $strength)
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
     * @param string $time
     *
     * @throws InvalidSsmlException
     */
    public function pauseTime(string $time)
    {
        if (1 !== preg_match('/^(\d+(s|ms))$/i', $time)) {
            throw new InvalidSsmlException('Time must be seconds or milliseconds!');
        }
        $this->parts[] = sprintf('<break time="%s" />', $time);
    }

    /**
     * Say a text with effect.
     *
     * @param string $text
     * @param string $effect
     *
     * @throws InvalidSsmlException
     */
    public function sayWithAmazonEffect(string $text, string $effect = self::AMAZON_EFFECT_WHISPERED)
    {
        if (!in_array($effect, self::AMAZON_EFFECTS, true)) {
            throw new InvalidSsmlException(sprintf('Amazon:effect name must be one of "%s"!', implode(',', self::AMAZON_EFFECTS)));
        }
        $this->parts[] = sprintf('<amazon:effect name="%s">%s</amazon:effect>', $effect, $text);
    }

    /**
     * Whisper a text.
     *
     * @param string $text
     */
    public function whisper(string $text)
    {
        $this->sayWithAmazonEffect($text, self::AMAZON_EFFECT_WHISPERED);
    }

    /**
     * Say with emphasis.
     *
     * @param string $text
     * @param string $level
     *
     * @throws InvalidSsmlException
     */
    public function emphasis(string $text, string $level)
    {
        if (!in_array($level, self::EMPHASIS_LEVELS, true)) {
            throw new InvalidSsmlException(sprintf('Emphasis level must be one of "%s"!', implode(',', self::EMPHASIS_LEVELS)));
        }
        $this->parts[] = sprintf('<emphasis level="%s">%s</emphasis>', $level, $text);
    }

    /**
     * Say a text pronounced in the given language.
     *
     * @param string $language
     * @param string $text
     *
     * @throws InvalidSsmlException
     */
    public function pronounceInLanguage(string $language, string $text)
    {
        if (!in_array($language, self::LANGUAGE_LIST, true)) {
            throw new InvalidSsmlException(sprintf('Language must be one of "%s"!', implode(',', self::LANGUAGE_LIST)));
        }
        $this->parts[] = sprintf('<lang xml:lang="%s">%s</lang>', $language, $text);
    }

    /**
     * Say a paragraph.
     *
     * @param string $paragraph
     */
    public function paragraph(string $paragraph)
    {
        $this->parts[] = sprintf('<p>%s</p>', $paragraph);
    }

    /**
     * Say a text with a phoneme.
     *
     * @param string $alphabet
     * @param string $ph
     * @param string $text
     *
     * @throws InvalidSsmlException
     */
    public function phoneme(string $alphabet, string $ph, string $text)
    {
        if (!in_array($alphabet, self::PHONEME_ALPHABETS, true)) {
            throw new InvalidSsmlException(sprintf('Phoneme alphabet must be one of "%s"!', implode(',', self::PHONEME_ALPHABETS)));
        }
        $this->parts[] = sprintf('<phoneme alphabet="%s" ph="%s">%s</phoneme>', $alphabet, $ph, $text);
    }

    /**
     * Say a text with a prosody.
     *
     * There are three different modes of prosody: volume, pitch, and rate.
     * For more details @see https://developer.amazon.com/de/docs/custom-skills/speech-synthesis-markup-language-ssml-reference.html#prosody
     *
     * @param string $mode
     * @param string $value
     * @param string $text
     *
     * @throws InvalidSsmlException
     */
    public function prosody(string $mode, string $value, string $text)
    {
        if (!isset(self::PROSODIES[$mode])) {
            throw new InvalidSsmlException(sprintf('Prosody mode must be one of "%s"!', implode(',', array_keys(self::PROSODIES))));
        }
        // todo validate value for mode
        $this->parts[] = sprintf('<prosody %s="%s">%s</prosody>', $mode, $value, $text);
    }

    /**
     * Say a sentence.
     *
     * @param string $text
     */
    public function sentence(string $text)
    {
        $this->parts[] = sprintf('<s>%s</s>', $text);
    }

    /**
     * Say a text with interpretation.
     *
     * @param string $interpretAs
     * @param string $text
     * @param string $format
     *
     * @throws InvalidSsmlException
     */
    public function sayAs(string $interpretAs, string $text, string $format = '')
    {
        if (!in_array($interpretAs, self::SAY_AS_INTERPRET_AS, true)) {
            throw new InvalidSsmlException(sprintf('Interpret as attribute must be one of "%s"!', implode(',', self::SAY_AS_INTERPRET_AS)));
        }
        if ($format) {
            $this->parts[] = sprintf('<say-as interpret-as="%s" format="%s">%s</say-as>', $interpretAs, $format, $text);
        } else {
            $this->parts[] = sprintf('<say-as interpret-as="%s">%s</say-as>', $interpretAs, $text);
        }
    }

    /**
     * Say an alias.
     * For example replace the abbreviated chemical elements with the full words.
     *
     * @param string $alias
     * @param string $text
     */
    public function alias(string $alias, string $text)
    {
        $this->parts[] = sprintf('<sub alias="%s">%s</sub>', $alias, $text);
    }

    /**
     * Say a word with defined word's parts to speach.
     *
     * @param string $role
     * @param string $text
     *
     * @throws InvalidSsmlException
     */
    public function word(string $role, string $text)
    {
        if (!in_array($role, self::INTERPRET_WORDS, true)) {
            throw new InvalidSsmlException(sprintf('Interpret as attribute must be one of "%s"!', implode(',', self::INTERPRET_WORDS)));
        }
        $this->parts[] = sprintf('<w role="%s">%s</w>', $role, $text);
    }
}
