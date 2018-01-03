<?php

namespace MaxBeckers\AmazonAlexa\Helper;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
interface SsmlTypes
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
    const INTERPRET_WORD_VB         = 'amazon:VB';
    const INTERPRET_WORD_VBD        = 'amazon:VBD';
    const INTERPRET_WORD_NN         = 'amazon:NN';
    const INTERPRET_WORD_SENSE_1    = 'amazon:SENSE_1';
    const INTERPRET_WORDS           = [
        self::INTERPRET_WORD_VB,
        self::INTERPRET_WORD_VBD,
        self::INTERPRET_WORD_NN,
        self::INTERPRET_WORD_SENSE_1,
    ];
}
