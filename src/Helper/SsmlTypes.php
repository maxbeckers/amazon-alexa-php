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
    const LANGUAGE_EN_US = 'en-US';
    const LANGUAGE_EN_GB = 'en-GB';
    const LANGUAGE_EN_IN = 'en-IN';
    const LANGUAGE_EN_AU = 'en-AU';
    const LANGUAGE_EN_CA = 'en-CA';
    const LANGUAGE_DE_DE = 'de-DE';
    const LANGUAGE_ES_ES = 'es-ES';
    const LANGUAGE_IT_IT = 'it-IT';
    const LANGUAGE_JA_JP = 'ja-JP';
    const LANGUAGE_FR_FR = 'fr-FR';
    const LANGUAGE_LIST  = [
        self::LANGUAGE_EN_US,
        self::LANGUAGE_EN_GB,
        self::LANGUAGE_EN_IN,
        self::LANGUAGE_EN_AU,
        self::LANGUAGE_EN_CA,
        self::LANGUAGE_DE_DE,
        self::LANGUAGE_ES_ES,
        self::LANGUAGE_IT_IT,
        self::LANGUAGE_JA_JP,
        self::LANGUAGE_FR_FR,
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
    const VOICE_EN_US_IVY      = 'Ivy';
    const VOICE_EN_US_JOANNA   = 'Joanna';
    const VOICE_EN_US_JOEY     = 'Joey';
    const VOICE_EN_US_JUSTIN   = 'Justin';
    const VOICE_EN_US_KENDRA   = 'Kendra';
    const VOICE_EN_US_KIMBERLY = 'Kimberly';
    const VOICE_EN_US_MATTHEW  = 'Matthew';
    const VOICE_EN_US_SALLI    = 'Salli';
    const VOICE_EN_AU_NICOLE   = 'Nicole';
    const VOICE_EN_AU_RUSSELL  = 'Russell';
    const VOICE_EN_GB_AMY      = 'Amy';
    const VOICE_EN_GB_BRIAN    = 'Brian';
    const VOICE_EN_GB_EMMA     = 'Emma';
    const VOICE_EN_IN_ADITI    = 'Aditi';
    const VOICE_EN_IN_RAVEENA  = 'Raveena';
    const VOICE_DE_DE_HANS     = 'Hans';
    const VOICE_DE_DE_MARLENE  = 'Marlene';
    const VOICE_DE_DE_VICKI    = 'Vicki';
    const VOICE_ES_ES_CONCHITA = 'Conchita';
    const VOICE_ES_ES_ENRIQUE  = 'Enrique';
    const VOICE_IT_IT_CARLA    = 'Carla';
    const VOICE_IT_IT_GIORGIO  = 'Giorgio';
    const VOICE_JA_JP_MIZUKI   = 'Mizuki';
    const VOICE_JA_JP_TAKUMI   = 'Takumi';
    const VOICE_FR_FR_CELINE   = 'Celine';
    const VOICE_FR_FR_LEA      = 'Lea';
    const VOICE_FR_FR_MATHIEU  = 'Mathieu';
    const VOICES               = [
        self::VOICE_EN_US_IVY,
        self::VOICE_EN_US_JOANNA,
        self::VOICE_EN_US_JOEY,
        self::VOICE_EN_US_JUSTIN,
        self::VOICE_EN_US_KENDRA,
        self::VOICE_EN_US_KIMBERLY,
        self::VOICE_EN_US_MATTHEW,
        self::VOICE_EN_US_SALLI,
        self::VOICE_EN_AU_RUSSELL,
        self::VOICE_EN_GB_AMY,
        self::VOICE_EN_GB_BRIAN,
        self::VOICE_EN_GB_EMMA,
        self::VOICE_EN_IN_ADITI,
        self::VOICE_EN_IN_RAVEENA,
        self::VOICE_DE_DE_HANS,
        self::VOICE_DE_DE_MARLENE,
        self::VOICE_DE_DE_VICKI,
        self::VOICE_ES_ES_CONCHITA,
        self::VOICE_ES_ES_ENRIQUE,
        self::VOICE_IT_IT_CARLA,
        self::VOICE_IT_IT_GIORGIO,
        self::VOICE_JA_JP_MIZUKI,
        self::VOICE_JA_JP_TAKUMI,
        self::VOICE_FR_FR_CELINE,
        self::VOICE_FR_FR_LEA,
        self::VOICE_FR_FR_MATHIEU,
    ];
    const INTERPRET_WORD_VB      = 'amazon:VB';
    const INTERPRET_WORD_VBD     = 'amazon:VBD';
    const INTERPRET_WORD_NN      = 'amazon:NN';
    const INTERPRET_WORD_SENSE_1 = 'amazon:SENSE_1';
    const INTERPRET_WORDS        = [
        self::INTERPRET_WORD_VB,
        self::INTERPRET_WORD_VBD,
        self::INTERPRET_WORD_NN,
        self::INTERPRET_WORD_SENSE_1,
    ];
}
