[![Build Status](https://scrutinizer-ci.com/g/maxbeckers/amazon-alexa-php/badges/build.png?b=master)](https://scrutinizer-ci.com/g/maxbeckers/amazon-alexa-php/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/maxbeckers/amazon-alexa-php/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/maxbeckers/amazon-alexa-php/?branch=master)
[![Coverage Status](https://scrutinizer-ci.com/g/maxbeckers/amazon-alexa-php/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/maxbeckers/amazon-alexa-php/?branch=master)
[![MIT Licence](https://badges.frapsoft.com/os/mit/mit.svg?v=103)](https://opensource.org/licenses/mit-license.php)
[![contributions welcome](https://img.shields.io/badge/contributions-welcome-brightgreen.svg?style=flat)](https://github.com/maxbeckers/amazon-alexa-php/issues)

# Amazon Alexa PHP Library

A modern PHP library for building Amazon Alexa skills with clean, maintainable code. This library simplifies handling Alexa requests by providing a robust validation system, flexible request handlers, and helper utilities for common tasks.

## 🚀 Features

- **Request Validation**: Automatic verification of Amazon request signatures
- **Flexible Handler System**: Easy-to-extend request handler architecture
- **SSML Support**: Built-in Speech Synthesis Markup Language generator
- **Device Address API**: Helper for accessing user location data
- **PHP 8.2+ Ready**: Leverages modern PHP features and type safety
- **Symfony Integration**: Available bundle for Symfony applications

## 📋 Requirements

- PHP 8.2 or higher
- Composer

## 🔧 Installation

```bash
composer require maxbeckers/amazon-alexa-php
```

## 🚀 Quick Start

### Basic Request Handling

```php
<?php

use MaxBeckers\AmazonAlexa\Request\Request;
use MaxBeckers\AmazonAlexa\Validation\RequestValidator;
use MaxBeckers\AmazonAlexa\RequestHandler\RequestHandlerRegistry;

// 1. Parse incoming request
$requestBody = file_get_contents('php://input');
$alexaRequest = Request::fromAmazonRequest(
    $requestBody, 
    $_SERVER['HTTP_SIGNATURECERTCHAINURL'] ?? '', 
    $_SERVER['HTTP_SIGNATURE'] ?? ''
);

// 2. Validate request authenticity
$validator = new RequestValidator();
$validator->validate($alexaRequest);

// 3. Handle request
$registry = new RequestHandlerRegistry();
$registry->addHandler(new MyIntentHandler());

$handler = $registry->getSupportingHandler($alexaRequest);
$response = $handler->handleRequest($alexaRequest);

// 4. Send response
header('Content-Type: application/json');
echo json_encode($response);
```

## 🎯 Creating Request Handlers

### Simple Intent Handler (PHP 8.2+)

```php
<?php

use MaxBeckers\AmazonAlexa\Request\Request;
use MaxBeckers\AmazonAlexa\Response\Response;
use MaxBeckers\AmazonAlexa\RequestHandler\AbstractRequestHandler;
use MaxBeckers\AmazonAlexa\Request\Request\Standard\IntentRequest;

class WelcomeIntentHandler extends AbstractRequestHandler
{
    public function __construct(
        private readonly array $supportedApplicationIds = ['amzn1.ask.skill.your-skill-id']
    ) {
        parent::__construct();
    }

    public function supportsRequest(Request $request): bool
    {
        return $request->request instanceof IntentRequest &&
               $request->request->intent->name === 'WelcomeIntent';
    }

    public function handleRequest(Request $request): Response
    {
        return $this->responseHelper->respond(
            outputSpeech: 'Welcome to our amazing skill!',
            shouldEndSession: false
        );
    }
}
```

### Advanced Handler with Slots

```php
<?php

use MaxBeckers\AmazonAlexa\Request\Request;
use MaxBeckers\AmazonAlexa\Response\Response;
use MaxBeckers\AmazonAlexa\RequestHandler\AbstractRequestHandler;
use MaxBeckers\AmazonAlexa\Request\Request\Standard\IntentRequest;

class UserInfoHandler extends AbstractRequestHandler
{
    public function __construct(
        private readonly array $supportedApplicationIds = ['amzn1.ask.skill.your-skill-id']
    ) {
        parent::__construct();
    }

    public function supportsRequest(Request $request): bool
    {
        return $request->request instanceof IntentRequest &&
               $request->request->intent->name === 'GetUserInfoIntent';
    }

    public function handleRequest(Request $request): Response
    {
        $intentRequest = $request->request;
        $userName = $intentRequest->intent->slots['userName']->value ?? 'friend';
        
        $message = match($userName) {
            'admin' => 'Hello administrator! You have special privileges.',
            'guest' => 'Welcome, guest user. Limited features available.',
            default => "Nice to meet you, {$userName}!"
        };

        return $this->responseHelper->respond($message);
    }
}
```

## 🎤 SSML Generation

Create rich speech responses with the SSML generator:

```php
<?php

use MaxBeckers\AmazonAlexa\Helper\SsmlGenerator;

$ssmlGenerator = new SsmlGenerator();
$ssmlGenerator
    ->say('Welcome to our cooking skill!')
    ->pauseStrength(SsmlGenerator::BREAK_STRENGTH_MEDIUM)
    ->say('Today we will learn about')
    ->emphasis('amazing', SsmlGenerator::EMPHASIS_STRONG)
    ->say('pasta recipes.')
    ->pauseTime('2s')
    ->say('Let\'s get started!');

$ssml = $ssmlGenerator->getSsml();
// Result: <speak>Welcome to our cooking skill! <break strength="medium" /> Today we will learn about <emphasis level="strong">amazing</emphasis> pasta recipes. <break time="2s" /> Let's get started!</speak>
```

## 📍 Device Address Information

Access user location data with proper permissions:

```php
<?php

use MaxBeckers\AmazonAlexa\Helper\DeviceAddressInformationHelper;

$addressHelper = new DeviceAddressInformationHelper();

try {
    // Get full address (requires "read::alexa:device:all:address" permission)
    $fullAddress = $addressHelper->getAddress($request);
    
    // Get country and postal code only (requires "read::alexa:device:all:address:country_and_postal_code" permission)
    $countryAndPostalCode = $addressHelper->getCountryAndPostalCode($request);
    
    $response = $this->responseHelper->respond(
        "I found your location in {$fullAddress->city}, {$fullAddress->stateOrRegion}"
    );
} catch (Exception $e) {
    $response = $this->responseHelper->respond(
        'I need permission to access your address. Please check your Alexa app.'
    );
}
```

## 🛡️ Error Handling

Implement robust error handling:

```php
<?php

use MaxBeckers\AmazonAlexa\Exception\ValidationException;

try {
    $validator = new RequestValidator();
    $validator->validate($alexaRequest);
} catch (ValidationException $e) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid request signature']);
    exit;
} catch (Exception $e) {
    http_response_code(500);
    error_log('Alexa skill error: ' . $e->getMessage());
    echo json_encode(['error' => 'Internal server error']);
    exit;
}
```

## 🔗 Advanced Usage

### Custom Response Builder

```php
<?php

use MaxBeckers\AmazonAlexa\Response\Response;
use MaxBeckers\AmazonAlexa\Response\OutputSpeech;
use MaxBeckers\AmazonAlexa\Response\Card;

public function handleRequest(Request $request): Response
{
    $outputSpeech = new OutputSpeech();
    $outputSpeech->type = OutputSpeech::TYPE_SSML;
    $outputSpeech->ssml = '<speak>Custom SSML response</speak>';
    
    $card = new Card();
    $card->type = Card::TYPE_SIMPLE;
    $card->title = 'Skill Response';
    $card->content = 'This appears in the Alexa app';
    
    $response = new Response();
    $response->outputSpeech = $outputSpeech;
    $response->card = $card;
    $response->shouldEndSession = false;
    
    return $response;
}
```

### Registry with Multiple Handlers

```php
<?php

$registry = new RequestHandlerRegistry();
$registry->addHandler(new LaunchRequestHandler());
$registry->addHandler(new WelcomeIntentHandler());
$registry->addHandler(new HelpIntentHandler());
$registry->addHandler(new StopIntentHandler());
$registry->addHandler(new SessionEndedRequestHandler());
```

## 🎛️ Symfony Integration

For Symfony applications, use the dedicated bundle:

```bash
composer require maxbeckers/amazon-alexa-bundle
```

Visit [maxbeckers/amazon-alexa-bundle](https://github.com/maxbeckers/amazon-alexa-bundle) for detailed integration instructions.

## 📚 Documentation

- [Amazon Alexa Skills Kit Documentation](https://developer.amazon.com/docs/ask-overviews/build-skills-with-the-alexa-skills-kit.html)
- [Device Address API](https://developer.amazon.com/docs/custom-skills/device-address-api.html)
- [SSML Reference](https://developer.amazon.com/docs/custom-skills/speech-synthesis-markup-language-ssml-reference.html)

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request. For major changes, please open an issue first to discuss what you would like to change.

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](https://opensource.org/licenses/mit-license.php) file for details.