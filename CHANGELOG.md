# Changelog
All Notable changes to `flipboxdigital\salesforce` will be documented in this file

## 2.2.0.1 - 2018-05-03
### Fixed
- When reference data passed through pipeline, HTTP Relay was using it as it's expected response.

## 2.2.0 - 2018-05-03
### Removed
- Removed the HTTP Response Transformer pipeline in favor of simply adding a transformer stage.
- Unused response Collection classes

### Changed
- Overall flow of transforming data via the pipeline

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
