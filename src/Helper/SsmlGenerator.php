<?php

namespace MaxBeckers\AmazonAlexa\Helper;

use MaxBeckers\AmazonAlexa\Exception\InvalidSsmlException;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class SsmlGenerator
{
    const AMAZON_EFFECT_WHISPERED = 'whispered';
    const AMAZON_EFFECTS          = [self::AMAZON_EFFECT_WHISPERED];
    const BREAK_STRENGTH_NONE     = 'none';
    const BREAK_STRENGTH_X_WEAK   = 'x-weak';
    const BREAK_STRENGTH_WEAK     = 'weak';
    const BREAK_STRENGTH_MEDIUM   = 'medium';
    const BREAK_STRENGTH_STRONG   = 'strong';
    const BREAK_STRENGTH_X_STRONG = 'x-strong';
    const BREAK_STRENGTHS         = [
        self::BREAK_STRENGTH_NONE,
        self::BREAK_STRENGTH_X_WEAK,
        self::BREAK_STRENGTH_WEAK,
        self::BREAK_STRENGTH_MEDIUM,
        self::BREAK_STRENGTH_STRONG,
        self::BREAK_STRENGTH_X_STRONG,
    ];
    const EMPHASIS_LEVEL_STRONG   = 'strong';
    const EMPHASIS_LEVEL_MODERATE = 'moderate';
    const EMPHASIS_LEVEL_REDUCED  = 'reduced';
    const EMPHASIS_LEVELS         = [
        self::EMPHASIS_LEVEL_STRONG,
        self::EMPHASIS_LEVEL_MODERATE,
        self::EMPHASIS_LEVEL_REDUCED,
    ];
    const PHONEME_ALPHABET_IPA     = 'ipa';
    const PHONEME_ALPHABET_X_SAMPA = 'x-sampa';
    const PHONEME_ALPHABETS        = [
        self::PHONEME_ALPHABET_IPA,
        self::PHONEME_ALPHABET_X_SAMPA,
    ];
    const PROSODY_PITCH              = 'pitch';
    const PROSODY_PITCH_X_LOW        = 'x-low';
    const PROSODY_PITCH_LOW          = 'low';
    const PROSODY_PITCH_MEDIUM       = 'medium';
    const PROSODY_PITCH_LOUD         = 'loud';
    const PROSODY_PITCH_X_LOUD       = 'x-loud';
    const PROSODY_PITCH_PERCENT_UP   = '+n%';
    const PROSODY_PITCH_PERCENT_DOWN = '-n%';
    const PROSODY_RATE               = 'rate';
    const PROSODY_RATE_X_SLOW        = 'x-slow';
    const PROSODY_RATE_SLOW          = 'slow';
    const PROSODY_RATE_MEDIUM        = 'medium';
    const PROSODY_RATE_FAST          = 'fast';
    const PROSODY_RATE_X_FAST        = 'x-fast';
    const PROSODY_RATE_PERCENT       = 'n%';
    const PROSODY_VOLUME             = 'volume';
    const PROSODY_VOLUME_SILENT      = 'silent';
    const PROSODY_VOLUME_X_SOFT      = 'x-soft';
    const PROSODY_VOLUME_SOFT        = 'soft';
    const PROSODY_VOLUME_MEDIUM      = 'medium';
    const PROSODY_VOLUME_LOUD        = 'loud';
    const PROSODY_VOLUME_X_LOUD      = 'x-loud';
    const PROSODY_VOLUME_DB_UP       = '+ndB';
    const PROSODY_VOLUME_DB_DOWN     = '-ndB';
    const PROSODIES                  = [
        self::PROSODY_PITCH => [
            self::PROSODY_PITCH_X_LOW,
            self::PROSODY_PITCH_LOW,
            self::PROSODY_PITCH_MEDIUM,
            self::PROSODY_PITCH_LOUD,
            self::PROSODY_PITCH_X_LOUD,
            self::PROSODY_PITCH_PERCENT_UP,
            self::PROSODY_PITCH_PERCENT_DOWN,
        ],
        self::PROSODY_RATE => [
            self::PROSODY_RATE_X_SLOW,
            self::PROSODY_RATE_SLOW,
            self::PROSODY_RATE_MEDIUM,
            self::PROSODY_RATE_FAST,
            self::PROSODY_RATE_X_FAST,
            self::PROSODY_RATE_PERCENT,
        ],
        self::PROSODY_VOLUME => [
            self::PROSODY_VOLUME_SILENT,
            self::PROSODY_VOLUME_X_SOFT,
            self::PROSODY_VOLUME_SOFT,
            self::PROSODY_VOLUME_MEDIUM,
            self::PROSODY_VOLUME_LOUD,
            self::PROSODY_VOLUME_X_LOUD,
            self::PROSODY_VOLUME_DB_UP,
            self::PROSODY_VOLUME_DB_DOWN,
        ],
    ];
    const SAY_AS_INTERPRET_CHARACTERS   = 'characters';
    const SAY_AS_INTERPRET_SPELL_OUT    = 'spell-out';
    const SAY_AS_INTERPRET_CARDINAL     = 'cardinal';
    const SAY_AS_INTERPRET_NUMBER       = 'number';
    const SAY_AS_INTERPRET_ORDINAL      = 'ordinal';
    const SAY_AS_INTERPRET_DIGITS       = 'digits';
    const SAY_AS_INTERPRET_FRACTION     = 'fraction';
    const SAY_AS_INTERPRET_UNIT         = 'unit';
    const SAY_AS_INTERPRET_DATE         = 'date';
    const SAY_AS_INTERPRET_TIME         = 'time';
    const SAY_AS_INTERPRET_TELEPHONE    = 'telephone';
    const SAY_AS_INTERPRET_ADDRESS      = 'address';
    const SAY_AS_INTERPRET_INTERJECTION = 'interjection';
    const SAY_AS_INTERPRET_EXPLETIVE    = 'expletive';
    const SAY_AS_INTERPRET_AS           = [
        self::SAY_AS_INTERPRET_CHARACTERS,
        self::SAY_AS_INTERPRET_SPELL_OUT,
        self::SAY_AS_INTERPRET_CARDINAL,
        self::SAY_AS_INTERPRET_NUMBER,
        self::SAY_AS_INTERPRET_ORDINAL,
        self::SAY_AS_INTERPRET_DIGITS,
        self::SAY_AS_INTERPRET_FRACTION,
        self::SAY_AS_INTERPRET_UNIT,
        self::SAY_AS_INTERPRET_DATE,
        self::SAY_AS_INTERPRET_TIME,
        self::SAY_AS_INTERPRET_TELEPHONE,
        self::SAY_AS_INTERPRET_ADDRESS,
        self::SAY_AS_INTERPRET_INTERJECTION,
        self::SAY_AS_INTERPRET_EXPLETIVE,
    ];

    /**
     * @var string[]
     */
    private $parts = [];

    /**
     * @return string
     */
    public function getSsml()
    {
        return sprintf('<speak>%s</speak>', implode('', $this->parts));
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
        if (1 !== preg_match('/^(https:\/\/.*\.mp3.*)$/i', $mp3Url)) {
            throw new InvalidSsmlException('"%s" in not a valid mp3 url!', $mp3Url);
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
            throw new InvalidSsmlException('Break strength must be one of "%s"!', implode(',', self::BREAK_STRENGTHS));
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
            throw new InvalidSsmlException('Amazon:effect name must be one of "%s"!', implode(',', self::AMAZON_EFFECTS));
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
            throw new InvalidSsmlException('Emphasis level must be one of "%s"!', implode(',', self::EMPHASIS_LEVELS));
        }
        $this->parts[] = sprintf('<emphasis level="%s">%s</emphasis>', $level, $text);
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
            throw new InvalidSsmlException('Phoneme alphabet must be one of "%s"!', implode(',', self::PHONEME_ALPHABETS));
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
            throw new InvalidSsmlException('Prosody mode must be one of "%s"!', implode(',', self::PROSODIES));
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
            throw new InvalidSsmlException('Interpret as attribute must be one of "%s"!', implode(',', self::SAY_AS_INTERPRET_AS));
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
}
