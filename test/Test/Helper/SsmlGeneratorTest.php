<?php

namespace MaxBeckers\AmazonAlexa\Test\Helper;

use MaxBeckers\AmazonAlexa\Exception\InvalidSsmlException;
use MaxBeckers\AmazonAlexa\Helper\SsmlGenerator;
use PHPUnit\Framework\TestCase;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class SsmlGeneratorTest extends TestCase
{
    public function testClear()
    {
        $ssmlGenerator = new SsmlGenerator();
        $this->assertSame('<speak></speak>', $ssmlGenerator->getSsml());
        $ssmlGenerator->say('Just a Test.');
        $this->assertSame('<speak>Just a Test.</speak>', $ssmlGenerator->getSsml());
        $ssmlGenerator->clear();
        $this->assertSame('<speak></speak>', $ssmlGenerator->getSsml());
    }

    public function testSay()
    {
        $ssmlGenerator = new SsmlGenerator();
        $this->assertSame('<speak></speak>', $ssmlGenerator->getSsml());
        $ssmlGenerator->say('Just a Test.');
        $this->assertSame('<speak>Just a Test.</speak>', $ssmlGenerator->getSsml());
        $ssmlGenerator->say('And add more text.');
        $this->assertSame('<speak>Just a Test. And add more text.</speak>', $ssmlGenerator->getSsml());
    }

    public function testPlayMp3InvalidUrl()
    {
        $ssmlGenerator = new SsmlGenerator();
        $this->expectException(InvalidSsmlException::class);
        $ssmlGenerator->playMp3('http://invalid.mp3');
        $ssmlGenerator->playMp3('https://my.file/invalidmp3');
    }

    public function testPlayMp3()
    {
        $ssmlGenerator = new SsmlGenerator();
        $ssmlGenerator->playMp3('https://valid.mp3?start=3');
        $this->assertSame('<speak><audio src="https://valid.mp3?start=3" /></speak>', $ssmlGenerator->getSsml());
        $ssmlGenerator->playMp3('https://valid.mp3');
        $this->assertSame('<speak><audio src="https://valid.mp3?start=3" /> <audio src="https://valid.mp3" /></speak>', $ssmlGenerator->getSsml());
    }

    public function testPlayMp3Soundbank()
    {
        $ssmlGenerator = new SsmlGenerator();
        $ssmlGenerator->playMp3('soundbank://valid.item');
        $this->assertSame('<speak><audio src="soundbank://valid.item" /></speak>', $ssmlGenerator->getSsml());
    }

    public function testPauseStrengthInvalid()
    {
        $ssmlGenerator = new SsmlGenerator();
        $this->expectException(InvalidSsmlException::class);
        $ssmlGenerator->pauseStrength('invalid');
    }

    public function testPauseStrength()
    {
        $ssmlGenerator = new SsmlGenerator();
        $ssmlGenerator->say('one');
        $ssmlGenerator->pauseStrength(SsmlGenerator::BREAK_STRENGTH_MEDIUM);
        $ssmlGenerator->say('two');
        $this->assertSame(sprintf('<speak>one <break strength="%s" /> two</speak>', SsmlGenerator::BREAK_STRENGTH_MEDIUM), $ssmlGenerator->getSsml());
    }

    public function testPauseTimeInvalid()
    {
        $ssmlGenerator = new SsmlGenerator();
        $this->expectException(InvalidSsmlException::class);
        $ssmlGenerator->pauseTime('300');
        $ssmlGenerator->pauseTime('invalid');
    }

    public function testPauseTime()
    {
        $ssmlGenerator = new SsmlGenerator();
        $ssmlGenerator->say('one');
        $ssmlGenerator->pauseTime('50ms');
        $ssmlGenerator->say('two');
        $ssmlGenerator->pauseTime('1s');
        $ssmlGenerator->say('three');
        $this->assertSame('<speak>one <break time="50ms" /> two <break time="1s" /> three</speak>', $ssmlGenerator->getSsml());
    }

    public function testSayWithAmazonEffectInvalid()
    {
        $ssmlGenerator = new SsmlGenerator();
        $this->expectException(InvalidSsmlException::class);
        $ssmlGenerator->sayWithAmazonEffect('Just a test.', 'invalid');
    }

    public function testSayWithAmazonEffect()
    {
        $ssmlGenerator = new SsmlGenerator();
        $ssmlGenerator->sayWithAmazonEffect('Just a test.', SsmlGenerator::AMAZON_EFFECT_WHISPERED);
        $this->assertSame(sprintf('<speak><amazon:effect name="%s">Just a test.</amazon:effect></speak>', SsmlGenerator::AMAZON_EFFECT_WHISPERED), $ssmlGenerator->getSsml());
    }

    public function testWhisper()
    {
        $ssmlGenerator = new SsmlGenerator();
        $ssmlGenerator->whisper('Just a test.');
        $this->assertSame(sprintf('<speak><amazon:effect name="%s">Just a test.</amazon:effect></speak>', SsmlGenerator::AMAZON_EFFECT_WHISPERED), $ssmlGenerator->getSsml());
    }

    public function testEmphasisInvalid()
    {
        $ssmlGenerator = new SsmlGenerator();
        $this->expectException(InvalidSsmlException::class);
        $ssmlGenerator->emphasis('Just a test.', 'invalid');
    }

    public function testEmphasis()
    {
        $ssmlGenerator = new SsmlGenerator();
        $ssmlGenerator->emphasis('Just a test.', SsmlGenerator::EMPHASIS_LEVEL_STRONG);
        $this->assertSame(sprintf('<speak><emphasis level="%s">Just a test.</emphasis></speak>', SsmlGenerator::EMPHASIS_LEVEL_STRONG), $ssmlGenerator->getSsml());
    }

    public function testPronounceInLanguageInvalid()
    {
        $ssmlGenerator = new SsmlGenerator();
        $this->expectException(InvalidSsmlException::class);
        $ssmlGenerator->pronounceInLanguage('in-VA', 'invalid');
    }

    public function testEPronounceInLanguage()
    {
        $ssmlGenerator = new SsmlGenerator();
        $ssmlGenerator->pronounceInLanguage(SsmlGenerator::LANGUAGE_EN_US, 'Just a test.');
        $this->assertSame(sprintf('<speak><lang xml:lang="%s">Just a test.</lang></speak>', SsmlGenerator::LANGUAGE_EN_US), $ssmlGenerator->getSsml());
    }

    public function testParagraph()
    {
        $ssmlGenerator = new SsmlGenerator();
        $ssmlGenerator->paragraph('Just a test');
        $this->assertSame('<speak><p>Just a test</p></speak>', $ssmlGenerator->getSsml());
    }

    public function testPhonemeInvalid()
    {
        $ssmlGenerator = new SsmlGenerator();
        $this->expectException(InvalidSsmlException::class);
        $ssmlGenerator->phoneme('invalid', 'invalid', 'Just a test');
    }

    public function testPhonemeIpa()
    {
        $ssmlGenerator = new SsmlGenerator();
        $ssmlGenerator->phoneme(SsmlGenerator::PHONEME_ALPHABET_IPA, 'ˈbɑ.təl', 'bottle');
        $this->assertSame(sprintf('<speak><phoneme alphabet="%s" ph="ˈbɑ.təl">bottle</phoneme></speak>', SsmlGenerator::PHONEME_ALPHABET_IPA), $ssmlGenerator->getSsml());
    }

    public function testPhonemeXSampa()
    {
        $ssmlGenerator = new SsmlGenerator();
        $ssmlGenerator->phoneme(SsmlGenerator::PHONEME_ALPHABET_X_SAMPA, '"bA.t@l', 'bottle');
        $this->assertSame(sprintf('<speak><phoneme alphabet="%s" ph=""bA.t@l">bottle</phoneme></speak>', SsmlGenerator::PHONEME_ALPHABET_X_SAMPA), $ssmlGenerator->getSsml());
    }

    public function testProsodyInvalid()
    {
        $ssmlGenerator = new SsmlGenerator();
        $this->expectException(InvalidSsmlException::class);
        $ssmlGenerator->prosody('invalid', 'invalid', 'Just a Test');
    }

    public function testProsody()
    {
        $ssmlGenerator = new SsmlGenerator();
        $ssmlGenerator->prosody(SsmlGenerator::PROSODY_PITCH, SsmlGenerator::PROSODY_PITCH_MEDIUM, 'Just a test.');
        $this->assertSame(sprintf('<speak><prosody %s="%s">Just a test.</prosody></speak>', SsmlGenerator::PROSODY_PITCH, SsmlGenerator::PROSODY_PITCH_MEDIUM), $ssmlGenerator->getSsml());
    }

    public function testSentence()
    {
        $ssmlGenerator = new SsmlGenerator();
        $ssmlGenerator->sentence('Just a test');
        $this->assertSame('<speak><s>Just a test</s></speak>', $ssmlGenerator->getSsml());
    }

    public function testSayAsInvalid()
    {
        $ssmlGenerator = new SsmlGenerator();
        $this->expectException(InvalidSsmlException::class);
        $ssmlGenerator->sayAs('invalid', 'Just a Test');
    }

    public function testSayAs()
    {
        $ssmlGenerator = new SsmlGenerator();
        $ssmlGenerator->sayAs(SsmlGenerator::SAY_AS_INTERPRET_CHARACTERS, 'Test');
        $this->assertSame(sprintf('<speak><say-as interpret-as="%s">Test</say-as></speak>', SsmlGenerator::SAY_AS_INTERPRET_CHARACTERS), $ssmlGenerator->getSsml());
    }

    public function testSayAsDate()
    {
        $ssmlGenerator = new SsmlGenerator();
        $ssmlGenerator->sayAs(SsmlGenerator::SAY_AS_INTERPRET_DATE, '01011970', 'dmy');
        $this->assertSame(sprintf('<speak><say-as interpret-as="%s" format="%s">01011970</say-as></speak>', SsmlGenerator::SAY_AS_INTERPRET_DATE, 'dmy'), $ssmlGenerator->getSsml());
    }

    public function testAlias()
    {
        $ssmlGenerator = new SsmlGenerator();
        $ssmlGenerator->alias('magnesium', 'Mg');
        $this->assertSame('<speak><sub alias="magnesium">Mg</sub></speak>', $ssmlGenerator->getSsml());
    }

    public function testWordInvalid()
    {
        $ssmlGenerator = new SsmlGenerator();
        $this->expectException(InvalidSsmlException::class);
        $ssmlGenerator->word('invalid', 'Just a Test');
    }

    public function testWord()
    {
        $ssmlGenerator = new SsmlGenerator();
        $ssmlGenerator->word(SsmlGenerator::INTERPRET_WORD_VB, 'Just a test.');
        $this->assertSame(sprintf('<speak><w role="%s">Just a test.</w></speak>', SsmlGenerator::INTERPRET_WORD_VB), $ssmlGenerator->getSsml());
    }
}
