<?php

/**
 * @copyright  Copyright (c) Flipbox Digital Limited
 * @license    https://github.com/flipbox/salesforce/blob/master/LICENSE.md
 * @link       https://github.com/flipbox/salesforce
 */

namespace Flipbox\Salesforce\Pipeline\Pipelines;

use Flipbox\Pipeline\Pipelines\KeyPipeline;
use Flipbox\Salesforce\Pipeline\Processors\HttpResponseProcessor;
use Flipbox\Skeleton\Logger\AutoLoggerTrait;
use League\Pipeline\ProcessorInterface;

/**
 * A Pipeline intended to interact and transform with HTTP Responses
 *
 * @author Flipbox Factory <hello@flipboxfactory.com>
 * @since 1.0.0
 */
class HttpResponseTransformerPipeline extends KeyPipeline
{
    use AutoLoggerTrait;

    /**
     * @var ProcessorInterface
     */
    protected $processor = HttpResponseProcessor::class;
}
