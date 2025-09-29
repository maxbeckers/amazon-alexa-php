# Change Log

## [2.0.0](https://github.com/maxbeckers/amazon-alexa-php/tree/2.0.0) (TBD)
[Full Changelog](https://github.com/maxbeckers/amazon-alexa-php/compare/1.13.0...2.0.0)

**Breaking Changes:**
- **PHP 8.2+ Required**: Minimum PHP version upgraded from 7.1 to 8.2
- **Strict Types**: Added `declare(strict_types=1);` to all PHP files
- **Type Declarations**: Added proper type hints to all properties and method parameters
- **Modern PHP Features**: Updated code to use PHP 8.2+ features including:
  - Nullable type declarations (`?Type`)
  - Union types (`string|int`)
  - Readonly properties where appropriate
  - Updated class constant syntax

**Improvements:**
- Enhanced type safety with strict typing
- Better IDE support and auto-completion
- Improved error detection at development time
- Fixed timestamp handling for numeric values in `AlexaSkillEventRequest`
- Fixed property type mismatch in `ConnectionsResponseRequest`
- Updated GitHub Actions workflow to test PHP 8.2, 8.3, and 8.4
- Updated CS Fixer configuration for PHP 8.2+ compatibility

**Migration Guide:**
- Ensure your project runs on PHP 8.2 or higher
- Update any custom request handlers to include proper type declarations
- Review any code that depends on loose type handling

## [1.11.0](https://github.com/maxbeckers/amazon-alexa-php/tree/1.11.0) (2022-07-26)
[Full Changelog](https://github.com/maxbeckers/amazon-alexa-php/compare/1.10.0...1.11.0)

## [1.10.0](https://github.com/maxbeckers/amazon-alexa-php/tree/1.10.0) (2021-11-26)
[Full Changelog](https://github.com/maxbeckers/amazon-alexa-php/compare/1.9.0...1.10.0)

## [1.9.0](https://github.com/maxbeckers/amazon-alexa-php/tree/1.9.0) (2020-08-28)
[Full Changelog](https://github.com/maxbeckers/amazon-alexa-php/compare/1.8.0...1.9.0)

## [1.8.0](https://github.com/maxbeckers/amazon-alexa-php/tree/1.8.0) (2020-04-15)
[Full Changelog](https://github.com/maxbeckers/amazon-alexa-php/compare/1.7.0...1.8.0)

**Closed issues:**
- Add handling for Alexa Event requests [\#82](https://github.com/maxbeckers/amazon-alexa-php/issues/82)

## [1.7.0](https://github.com/maxbeckers/amazon-alexa-php/tree/1.7.0) (2019-12-19)
[Full Changelog](https://github.com/maxbeckers/amazon-alexa-php/compare/1.6.0...1.7.0)

## [1.6.0](https://github.com/maxbeckers/amazon-alexa-php/tree/1.6.0) (2018-06-13)
[Full Changelog](https://github.com/maxbeckers/amazon-alexa-php/compare/1.5.0...1.6.0)

## [1.5.0](https://github.com/maxbeckers/amazon-alexa-php/tree/1.5.0) (2018-06-05)
[Full Changelog](https://github.com/maxbeckers/amazon-alexa-php/compare/1.4.0...1.5.0)

## [1.4.0](https://github.com/maxbeckers/amazon-alexa-php/tree/1.4.0) (2018-05-21)
[Full Changelog](https://github.com/maxbeckers/amazon-alexa-php/compare/1.3.0...1.4.0)

## [1.3.0](https://github.com/maxbeckers/amazon-alexa-php/tree/1.3.0) (2018-01-24)
[Full Changelog](https://github.com/maxbeckers/amazon-alexa-php/compare/1.2.0...1.3.0)

**Closed issues:**
- Request validation fails if allow_url_fopen is disabled [\#65](https://github.com/maxbeckers/amazon-alexa-php/issues/65)
- SSML generator should escape XML control characters [\#57](https://github.com/maxbeckers/amazon-alexa-php/issues/57)

## [1.2.8](https://github.com/maxbeckers/amazon-alexa-php/tree/1.2.8) (2018-12-13)
[Full Changelog](https://github.com/maxbeckers/amazon-alexa-php/compare/1.2.7...1.2.8)

**Closed issues:**
- Response / Directives / AudioPlayer / AudioItem with metadata [\#58](https://github.com/maxbeckers/amazon-alexa-php/issues/58)

## [1.2.7](https://github.com/maxbeckers/amazon-alexa-php/tree/1.2.7) (2018-12-11)
[Full Changelog](https://github.com/maxbeckers/amazon-alexa-php/compare/1.2.6...1.2.7)

**Closed issues:**
- Permission Card [\#59](https://github.com/maxbeckers/amazon-alexa-php/issues/59)

## [1.2.6](https://github.com/maxbeckers/amazon-alexa-php/tree/1.2.6) (2018-11-20)
[Full Changelog](https://github.com/maxbeckers/amazon-alexa-php/compare/1.2.5...1.2.6)

## [1.2.5](https://github.com/maxbeckers/amazon-alexa-php/tree/1.2.5) (2018-11-20)
[Full Changelog](https://github.com/maxbeckers/amazon-alexa-php/compare/1.2.4...1.2.5)

**Closed issues:**
- Amazon Polly Integration [\#37](https://github.com/maxbeckers/amazon-alexa-php/issues/37)

## [1.2.4](https://github.com/maxbeckers/amazon-alexa-php/tree/1.2.4) (2018-11-16)
[Full Changelog](https://github.com/maxbeckers/amazon-alexa-php/compare/1.2.3...1.2.4)

## [1.2.3](https://github.com/maxbeckers/amazon-alexa-php/tree/1.2.3) (2018-11-16)
[Full Changelog](https://github.com/maxbeckers/amazon-alexa-php/compare/1.2.2...1.2.3)

**Closed issues:**
- SSML Generator implement lang-Tag [\#50](https://github.com/maxbeckers/amazon-alexa-php/issues/50)

## [1.2.2](https://github.com/maxbeckers/amazon-alexa-php/tree/1.2.2) (2018-08-20)
[Full Changelog](https://github.com/maxbeckers/amazon-alexa-php/compare/1.2.1...1.2.2)

**Closed issues:**

- PSR-4 namespaces for tests [\#44](https://github.com/maxbeckers/amazon-alexa-php/issues/44)
- UnitTests for MaxBeckers/AmazonAlexa/Response/Directives/Dialog namespace [\#42](https://github.com/maxbeckers/amazon-alexa-php/issues/42)
- Missing the CONTRIBUTING.md [\#38](https://github.com/maxbeckers/amazon-alexa-php/issues/38)

## [1.2.1](https://github.com/maxbeckers/amazon-alexa-php/tree/1.2.1) (2018-07-27)
[Full Changelog](https://github.com/maxbeckers/amazon-alexa-php/compare/1.2.0...1.2.1)

## [1.2.0](https://github.com/maxbeckers/amazon-alexa-php/tree/1.2.0) (2018-07-27)
[Full Changelog](https://github.com/maxbeckers/amazon-alexa-php/compare/1.1.0...1.2.0)

**Closed issues:**

- Implement Gadgets Skill API [\#28](https://github.com/maxbeckers/amazon-alexa-php/issues/28)
- Implement Game Engine interface [\#29](https://github.com/maxbeckers/amazon-alexa-php/issues/29)
- Implement CanFulfillIntentRequest [\#30](https://github.com/maxbeckers/amazon-alexa-php/issues/30)

## [1.1.3](https://github.com/maxbeckers/amazon-alexa-php/tree/1.1.3) (2018-05-17)
[Full Changelog](https://github.com/maxbeckers/amazon-alexa-php/compare/1.1.2...1.1.3)

## [1.1.2](https://github.com/maxbeckers/amazon-alexa-php/tree/1.1.2) (2018-03-21)
[Full Changelog](https://github.com/maxbeckers/amazon-alexa-php/compare/1.1.1...1.1.2)

## [1.1.1](https://github.com/maxbeckers/amazon-alexa-php/tree/1.1.1) (2018-03-15)
[Full Changelog](https://github.com/maxbeckers/amazon-alexa-php/compare/1.1.0...1.1.1)

## [1.1.0](https://github.com/maxbeckers/amazon-alexa-php/tree/1.1.0) (2018-02-15)
[Full Changelog](https://github.com/maxbeckers/amazon-alexa-php/compare/1.0.0...1.1.0)

**Closed issues:**

- Service for device address information [\#20](https://github.com/maxbeckers/amazon-alexa-php/issues/20)

## [1.0.16](https://github.com/maxbeckers/amazon-alexa-php/tree/1.0.16) (2018-02-06)
[Full Changelog](https://github.com/maxbeckers/amazon-alexa-php/compare/1.0.15...1.0.16)

## [1.0.15](https://github.com/maxbeckers/amazon-alexa-php/tree/1.0.15) (2018-01-22)
[Full Changelog](https://github.com/maxbeckers/amazon-alexa-php/compare/1.0.14...1.0.15)

**Closed issues:**

- PHP Version set too high? [\#18](https://github.com/maxbeckers/amazon-alexa-php/issues/18)

## [1.0.14](https://github.com/maxbeckers/amazon-alexa-php/tree/1.0.14) (2018-01-09)
[Full Changelog](https://github.com/maxbeckers/amazon-alexa-php/compare/1.0.13...1.0.14)

## [1.0.13](https://github.com/maxbeckers/amazon-alexa-php/tree/1.0.13) (2018-01-03)
[Full Changelog](https://github.com/maxbeckers/amazon-alexa-php/compare/1.0.12...1.0.13)

**Closed issues:**

- SSML Generator and Validator [\#17](https://github.com/maxbeckers/amazon-alexa-php/issues/17)

## [1.0.12](https://github.com/maxbeckers/amazon-alexa-php/tree/1.0.12) (2017-12-21)
[Full Changelog](https://github.com/maxbeckers/amazon-alexa-php/compare/1.0.11...1.0.12)

**Closed issues:**

- Load cert with guzzle or curl [\#14](https://github.com/maxbeckers/amazon-alexa-php/issues/14)

## [1.0.11](https://github.com/maxbeckers/amazon-alexa-php/tree/1.0.11) (2017-12-14)
[Full Changelog](https://github.com/maxbeckers/amazon-alexa-php/compare/1.0.10...1.0.11)

## [1.0.10](https://github.com/maxbeckers/amazon-alexa-php/tree/1.0.10) (2017-12-13)
[Full Changelog](https://github.com/maxbeckers/amazon-alexa-php/compare/1.0.9...1.0.10)

**Closed issues:**

- Example with Card [\#15](https://github.com/maxbeckers/amazon-alexa-php/issues/15)

## [1.0.9](https://github.com/maxbeckers/amazon-alexa-php/tree/1.0.9) (2017-12-11)
[Full Changelog](https://github.com/maxbeckers/amazon-alexa-php/compare/1.0.8...1.0.9)

**Closed issues:**

- Handle Session Ended Request - Allow null as a return value in AbstractRequestHandler::handleRequest? [\#11](https://github.com/maxbeckers/amazon-alexa-php/issues/11)

## [1.0.8](https://github.com/maxbeckers/amazon-alexa-php/tree/1.0.8) (2017-12-06)
[Full Changelog](https://github.com/maxbeckers/amazon-alexa-php/compare/1.0.7...1.0.8)

**Merged pull requests:**

- Allow null as a return value in AbstractRequestHandler [\#12](https://github.com/maxbeckers/amazon-alexa-php/pull/12) ([fabeat](https://github.com/fabeat))
- Display.ElementSelected Request & Hint Directive  [\#10](https://github.com/maxbeckers/amazon-alexa-php/pull/10) ([fabeat](https://github.com/fabeat))

## [1.0.7](https://github.com/maxbeckers/amazon-alexa-php/tree/1.0.7) (2017-12-04)
[Full Changelog](https://github.com/maxbeckers/amazon-alexa-php/compare/1.0.6...1.0.7)

## [1.0.6](https://github.com/maxbeckers/amazon-alexa-php/tree/1.0.6) (2017-12-04)
[Full Changelog](https://github.com/maxbeckers/amazon-alexa-php/compare/1.0.5...1.0.6)

**Merged pull requests:**

-  create\(\) Methods for VideoApp [\#9](https://github.com/maxbeckers/amazon-alexa-php/pull/9) ([fabeat](https://github.com/fabeat))

## [1.0.5](https://github.com/maxbeckers/amazon-alexa-php/tree/1.0.5) (2017-12-01)
[Full Changelog](https://github.com/maxbeckers/amazon-alexa-php/compare/1.0.4...1.0.5)

**Merged pull requests:**

- Dialog directives: Intent should be nullable in create\(\) method [\#8](https://github.com/maxbeckers/amazon-alexa-php/pull/8) ([fabeat](https://github.com/fabeat))

## [1.0.4](https://github.com/maxbeckers/amazon-alexa-php/tree/1.0.4) (2017-11-30)
[Full Changelog](https://github.com/maxbeckers/amazon-alexa-php/compare/1.0.3...1.0.4)

**Merged pull requests:**

- Dialog state constants for IntentRequest [\#7](https://github.com/maxbeckers/amazon-alexa-php/pull/7) ([fabeat](https://github.com/fabeat))

## [1.0.3](https://github.com/maxbeckers/amazon-alexa-php/tree/1.0.3) (2017-11-30)
[Full Changelog](https://github.com/maxbeckers/amazon-alexa-php/compare/1.0.2...1.0.3)

**Merged pull requests:**

- Added convenience methods for display directives [\#6](https://github.com/maxbeckers/amazon-alexa-php/pull/6) ([fabeat](https://github.com/fabeat))

## [1.0.2](https://github.com/maxbeckers/amazon-alexa-php/tree/1.0.2) (2017-11-29)
[Full Changelog](https://github.com/maxbeckers/amazon-alexa-php/compare/1.0.1...1.0.2)

**Merged pull requests:**

- Fixed phpunit tests [\#5](https://github.com/maxbeckers/amazon-alexa-php/pull/5) ([fabeat](https://github.com/fabeat))

## [1.0.1](https://github.com/maxbeckers/amazon-alexa-php/tree/1.0.1) (2017-11-29)
[Full Changelog](https://github.com/maxbeckers/amazon-alexa-php/compare/1.0.0...1.0.1)

**Closed issues:**

- Display Interface and Background Images not working properly [\#4](https://github.com/maxbeckers/amazon-alexa-php/issues/4)
- backgroundImage n [\#3](https://github.com/maxbeckers/amazon-alexa-php/issues/3)
- backgroundImage no [\#2](https://github.com/maxbeckers/amazon-alexa-php/issues/2)

## [1.0.0](https://github.com/maxbeckers/amazon-alexa-php/tree/1.0.0) (2017-10-02)
[Full Changelog](https://github.com/maxbeckers/amazon-alexa-php/compare/0.1.6...1.0.0)

## [0.1.6](https://github.com/maxbeckers/amazon-alexa-php/tree/0.1.6) (2017-07-31)
[Full Changelog](https://github.com/maxbeckers/amazon-alexa-php/compare/0.1.5...0.1.6)

## [0.1.5](https://github.com/maxbeckers/amazon-alexa-php/tree/0.1.5) (2017-07-26)
[Full Changelog](https://github.com/maxbeckers/amazon-alexa-php/compare/0.1.4...0.1.5)

## [0.1.4](https://github.com/maxbeckers/amazon-alexa-php/tree/0.1.4) (2017-07-25)
[Full Changelog](https://github.com/maxbeckers/amazon-alexa-php/compare/0.1.3...0.1.4)

**Closed issues:**

- Some Issues? [\#1](https://github.com/maxbeckers/amazon-alexa-php/issues/1)

## [0.1.3](https://github.com/maxbeckers/amazon-alexa-php/tree/0.1.3) (2017-07-21)
[Full Changelog](https://github.com/maxbeckers/amazon-alexa-php/compare/0.1.2...0.1.3)

## [0.1.2](https://github.com/maxbeckers/amazon-alexa-php/tree/0.1.2) (2017-07-12)
[Full Changelog](https://github.com/maxbeckers/amazon-alexa-php/compare/0.1.1...0.1.2)

## [0.1.1](https://github.com/maxbeckers/amazon-alexa-php/tree/0.1.1) (2017-07-10)


\* *This Change Log was automatically generated by [github_changelog_generator](https://github.com/skywinder/Github-Changelog-Generator)*
