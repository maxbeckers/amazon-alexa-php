<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Helper;

interface SsmlTypes
{
    public const AMAZON_EFFECT_WHISPERED = 'whispered';
    public const AMAZON_EFFECTS = [self::AMAZON_EFFECT_WHISPERED];
    public const BREAK_STRENGTH_NONE = 'none';
    public const BREAK_STRENGTH_X_WEAK = 'x-weak';
    public const BREAK_STRENGTH_WEAK = 'weak';
    public const BREAK_STRENGTH_MEDIUM = 'medium';
    public const BREAK_STRENGTH_STRONG = 'strong';
    public const BREAK_STRENGTH_X_STRONG = 'x-strong';
    public const BREAK_STRENGTHS = [
        self::BREAK_STRENGTH_NONE,
        self::BREAK_STRENGTH_X_WEAK,
        self::BREAK_STRENGTH_WEAK,
        self::BREAK_STRENGTH_MEDIUM,
        self::BREAK_STRENGTH_STRONG,
        self::BREAK_STRENGTH_X_STRONG,
    ];
    public const EMPHASIS_LEVEL_STRONG = 'strong';
    public const EMPHASIS_LEVEL_MODERATE = 'moderate';
    public const EMPHASIS_LEVEL_REDUCED = 'reduced';
    public const EMPHASIS_LEVELS = [
        self::EMPHASIS_LEVEL_STRONG,
        self::EMPHASIS_LEVEL_MODERATE,
        self::EMPHASIS_LEVEL_REDUCED,
    ];
    public const LANGUAGE_EN_US = 'en-US';
    public const LANGUAGE_EN_GB = 'en-GB';
    public const LANGUAGE_EN_IN = 'en-IN';
    public const LANGUAGE_EN_AU = 'en-AU';
    public const LANGUAGE_EN_CA = 'en-CA';
    public const LANGUAGE_DE_DE = 'de-DE';
    public const LANGUAGE_ES_ES = 'es-ES';
    public const LANGUAGE_IT_IT = 'it-IT';
    public const LANGUAGE_JA_JP = 'ja-JP';
    public const LANGUAGE_FR_FR = 'fr-FR';
    public const LANGUAGE_LIST = [
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
    public const PHONEME_ALPHABET_IPA = 'ipa';
    public const PHONEME_ALPHABET_X_SAMPA = 'x-sampa';
    public const PHONEME_ALPHABETS = [
        self::PHONEME_ALPHABET_IPA,
        self::PHONEME_ALPHABET_X_SAMPA,
    ];
    public const PROSODY_PITCH = 'pitch';
    public const PROSODY_PITCH_X_LOW = 'x-low';
    public const PROSODY_PITCH_LOW = 'low';
    public const PROSODY_PITCH_MEDIUM = 'medium';
    public const PROSODY_PITCH_LOUD = 'loud';
    public const PROSODY_PITCH_X_LOUD = 'x-loud';
    public const PROSODY_PITCH_PERCENT_UP = '+n%';
    public const PROSODY_PITCH_PERCENT_DOWN = '-n%';
    public const PROSODY_RATE = 'rate';
    public const PROSODY_RATE_X_SLOW = 'x-slow';
    public const PROSODY_RATE_SLOW = 'slow';
    public const PROSODY_RATE_MEDIUM = 'medium';
    public const PROSODY_RATE_FAST = 'fast';
    public const PROSODY_RATE_X_FAST = 'x-fast';
    public const PROSODY_RATE_PERCENT = 'n%';
    public const PROSODY_VOLUME = 'volume';
    public const PROSODY_VOLUME_SILENT = 'silent';
    public const PROSODY_VOLUME_X_SOFT = 'x-soft';
    public const PROSODY_VOLUME_SOFT = 'soft';
    public const PROSODY_VOLUME_MEDIUM = 'medium';
    public const PROSODY_VOLUME_LOUD = 'loud';
    public const PROSODY_VOLUME_X_LOUD = 'x-loud';
    public const PROSODY_VOLUME_DB_UP = '+ndB';
    public const PROSODY_VOLUME_DB_DOWN = '-ndB';
    public const PROSODIES = [
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
    public const SAY_AS_INTERPRET_CHARACTERS = 'characters';
    public const SAY_AS_INTERPRET_SPELL_OUT = 'spell-out';
    public const SAY_AS_INTERPRET_CARDINAL = 'cardinal';
    public const SAY_AS_INTERPRET_NUMBER = 'number';
    public const SAY_AS_INTERPRET_ORDINAL = 'ordinal';
    public const SAY_AS_INTERPRET_DIGITS = 'digits';
    public const SAY_AS_INTERPRET_FRACTION = 'fraction';
    public const SAY_AS_INTERPRET_UNIT = 'unit';
    public const SAY_AS_INTERPRET_DATE = 'date';
    public const SAY_AS_INTERPRET_TIME = 'time';
    public const SAY_AS_INTERPRET_TELEPHONE = 'telephone';
    public const SAY_AS_INTERPRET_ADDRESS = 'address';
    public const SAY_AS_INTERPRET_INTERJECTION = 'interjection';
    public const SAY_AS_INTERPRET_EXPLETIVE = 'expletive';
    public const SAY_AS_INTERPRET_AS = [
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
    public const VOICE_EN_US_IVY = 'Ivy';
    public const VOICE_EN_US_JOANNA = 'Joanna';
    public const VOICE_EN_US_JOEY = 'Joey';
    public const VOICE_EN_US_JUSTIN = 'Justin';
    public const VOICE_EN_US_KENDRA = 'Kendra';
    public const VOICE_EN_US_KIMBERLY = 'Kimberly';
    public const VOICE_EN_US_MATTHEW = 'Matthew';
    public const VOICE_EN_US_SALLI = 'Salli';
    public const VOICE_EN_AU_NICOLE = 'Nicole';
    public const VOICE_EN_AU_RUSSELL = 'Russell';
    public const VOICE_EN_GB_AMY = 'Amy';
    public const VOICE_EN_GB_BRIAN = 'Brian';
    public const VOICE_EN_GB_EMMA = 'Emma';
    public const VOICE_EN_IN_ADITI = 'Aditi';
    public const VOICE_EN_IN_RAVEENA = 'Raveena';
    public const VOICE_DE_DE_HANS = 'Hans';
    public const VOICE_DE_DE_MARLENE = 'Marlene';
    public const VOICE_DE_DE_VICKI = 'Vicki';
    public const VOICE_ES_ES_CONCHITA = 'Conchita';
    public const VOICE_ES_ES_ENRIQUE = 'Enrique';
    public const VOICE_IT_IT_CARLA = 'Carla';
    public const VOICE_IT_IT_GIORGIO = 'Giorgio';
    public const VOICE_JA_JP_MIZUKI = 'Mizuki';
    public const VOICE_JA_JP_TAKUMI = 'Takumi';
    public const VOICE_FR_FR_CELINE = 'Celine';
    public const VOICE_FR_FR_LEA = 'Lea';
    public const VOICE_FR_FR_MATHIEU = 'Mathieu';
    public const VOICES = [
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
    public const INTERPRET_WORD_VB = 'amazon:VB';
    public const INTERPRET_WORD_VBD = 'amazon:VBD';
    public const INTERPRET_WORD_NN = 'amazon:NN';
    public const INTERPRET_WORD_SENSE_1 = 'amazon:SENSE_1';
    public const INTERPRET_WORDS = [
        self::INTERPRET_WORD_VB,
        self::INTERPRET_WORD_VBD,
        self::INTERPRET_WORD_NN,
        self::INTERPRET_WORD_SENSE_1,
    ];
}
