<?php

use MaxBeckers\AmazonAlexa\Response\Card;
use MaxBeckers\AmazonAlexa\Response\Directives\Display\RenderTemplateDirective;
use MaxBeckers\AmazonAlexa\Response\OutputSpeech;
use MaxBeckers\AmazonAlexa\Response\Reprompt;
use MaxBeckers\AmazonAlexa\Response\ResponseBody;
use PHPUnit\Framework\TestCase;

/**
 * @author Fabian Graßl <fabian.grassl@db-n.com>
 */
class ResponseBodyTest extends TestCase
{
    public function testJsonSerialize()
    {
        $rb = new ResponseBody();
        $this->assertEquals(new ArrayObject(), $rb->jsonSerialize());
        $rb->shouldEndSession = true;
        $this->assertEquals(new ArrayObject(['shouldEndSession' => true]), $rb->jsonSerialize());
        $card             = new Card();
        $rb->card         = $card;
        $os               = new OutputSpeech();
        $rb->outputSpeech = $os;
        $directive        = new RenderTemplateDirective();
        $rb->addDirective($directive);
        $reprompt     = new Reprompt($rb->outputSpeech);
        $rb->reprompt = $reprompt;
        $this->assertEquals(new ArrayObject([
            'outputSpeech'     => $os,
            'card'             => $card,
            'reprompt'         => $reprompt,
            'shouldEndSession' => true,
            'directives'       => [$directive],
        ]), $rb->jsonSerialize());
    }
}
