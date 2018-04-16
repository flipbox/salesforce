<?php

/**
 * @copyright  Copyright (c) Flipbox Digital Limited
 * @license    https://github.com/flipbox/salesforce/blob/master/LICENSE.md
 * @link       https://github.com/flipbox/salesforce
 */

namespace Flipbox\Salesforce\Resources;

use Flipbox\Pipeline\Builders\BuilderTrait;
use Flipbox\Relay\Runner\Runner;
use Flipbox\Salesforce\Pipeline\Pipelines\HttpPipeline;
use Flipbox\Salesforce\Pipeline\Pipelines\HttpResponseTransformerPipeline;
use Flipbox\Salesforce\Salesforce;
use Flipbox\Skeleton\Object\AbstractObject;
use League\Pipeline\PipelineBuilderInterface;
use Psr\Log\LoggerInterface;

/**
 * A Relay pipeline builder intended to make building the Relay and Pipeline easier.
 *
 * @author Flipbox Factory <hello@flipboxfactory.com>
 * @since 1.0.0
 */
abstract class AbstractResource extends AbstractObject implements PipelineBuilderInterface
{
    use BuilderTrait;

    /**
     * @var Runner
     */
    protected $runner;

    /**
     * @var HttpResponseTransformerPipeline
     */
    protected $data;

    /**
     * @param Runner $runner
     * @param HttpResponseTransformerPipeline $data
     * @param LoggerInterface|null $logger
     * @param array $config
     */
    public function __construct(
        Runner $runner,
        HttpResponseTransformerPipeline $data,
        LoggerInterface $logger = null,
        $config = []
    ) {
        $this->logger = $logger ?: Salesforce::getLogger();
        $this->runner = $runner;
        $this->data = $data;
        parent::__construct($config);
    }

    /**
     * @inheritdoc
     */
    protected function createPipeline(array $config = []): HttpPipeline
    {
        return new HttpPipeline(
            function () {
                return call_user_func($this->runner);
            },
            $this->data,
            $config
        );
    }

    /**
     * @param null $source
     * @return mixed
     */
    public function execute($source = null)
    {
        // Resources do not pass a payload ... but they can pass a source, so that why this may look funny
        return call_user_func_array($this->build(), [null, $source]);
    }

    /**
     * @param mixed|null $source
     * @return mixed
     */
    public function __invoke($source = null)
    {
        return $this->execute($source);
    }

    /**
     * Add a stage to the data pipeline
     *
     * @param callable $stage
     * @param null $key
     * @return $this
     */
    public function addToDataPipeline(callable $stage, $key = null)
    {
        $this->data = $this->data->pipe($stage, $key);
        return $this;
    }
}
