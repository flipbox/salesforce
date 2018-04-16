<?php

/**
 * @copyright  Copyright (c) Flipbox Digital Limited
 * @license    https://github.com/flipbox/salesforce/blob/master/LICENSE.md
 * @link       https://github.com/flipbox/salesforce
 */

namespace Flipbox\Salesforce\Pipeline\Pipelines;

use Flipbox\Pipeline\Pipelines\Pipeline;
use Flipbox\Pipeline\Processors\Processor;
use Flipbox\Skeleton\Logger\AutoLoggerTrait;
use League\Pipeline\PipelineInterface;

/**
 * A Relay pipeline which only accepts a Relay Segment and Pipeline.  The intent is to run
 * the Relay Segment and use the pipeline to handle any additional processing (such as transformations, etc).
 *
 * @author Flipbox Factory <hello@flipboxfactory.com>
 * @since 1.0.0
 *
 * @method Processor getProcessor()
 */
class HttpPipeline extends Pipeline
{
    use AutoLoggerTrait;

    /**
     * @var callable|PipelineInterface
     */
    private $relay;

    /**
     * @var callable|PipelineInterface
     */
    private $data;

    /**
     * @inheritdoc
     */
    protected $processor = Processor::class;

    /**
     * @param callable $relay
     * @param callable $data
     * @param array $config
     */
    public function __construct(
        callable $relay,
        callable $data,
        $config = []
    ) {
        $this->relay = $relay;
        $this->data = $data;
        parent::__construct($config);
    }

    /**
     * @inheritdoc
     */
    public function process($payload = null, $source = null)
    {
        $stages = array_merge(
            [$this->relay, $this->data],
            $this->getStages()
        );

        return $this->getProcessor()->process($stages, $payload, $source);
    }
}
