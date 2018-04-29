# Changelog
All Notable changes to `flipboxdigital\salesforce` will be documented in this file

## 2.1.0 - 2018-04-29
### Added
- `\Flipbox\Salesforce\Connections\ConnectionInterface::getInstanceUrl()` to easily identify the Salesforce Instance.

## 2.0.1 - 2018-04-26
### Changed
- `\Flipbox\Salesforce\Pipeline\Processors\HttpResponseProcessor::processPayload` will always return an array, regardless if no content was returned.

## 2.0.0 - 2018-04-24
### Changed
- All caching now implements [PSR-16](https://www.php-fig.org/psr/psr-16/)

## 1.0.0 - 2018-04-16
- Initial release
