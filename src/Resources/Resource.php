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
use Flipbox\Salesforce\Pipeline\Stages\TransformerCollectionStage;
use Flipbox\Salesforce\Salesforce;
use Flipbox\Salesforce\Transformers\Collections\TransformerCollectionInterface;
use Flipbox\Skeleton\Object\AbstractObject;
use League\Pipeline\PipelineBuilderInterface;
use Psr\Log\LoggerInterface;

/**
 * A Relay pipeline builder intended to make building the Relay and Pipeline easier.
 *
 * @author Flipbox Factory <hello@flipboxfactory.com>
 * @since 1.0.0
 */
class Resource extends AbstractObject implements PipelineBuilderInterface
{
    use BuilderTrait;

    /**
     * @var Runner
     */
    protected $runner;

    /**
     * @var TransformerCollectionInterface|null
     */
    protected $transformer;

    /**
     * @param Runner $runner
     * @param TransformerCollectionInterface|null $transformer
     * @param LoggerInterface|null $logger
     * @param array $config
     */
    public function __construct(
        Runner $runner,
        TransformerCollectionInterface $transformer = null,
        LoggerInterface $logger = null,
        array $config = []
    ) {
        $this->setLogger($logger ?: Salesforce::getLogger());
        $this->runner = $runner;
        $this->transformer = $transformer;

        parent::__construct($config);
    }

    /**
     * @inheritdoc
     */
    protected function createPipeline(array $config = []): HttpPipeline
    {
        return new HttpPipeline(
            $this->runner,
            $this->createTransformerStage($this->transformer),
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
     * @param TransformerCollectionInterface|null $transformer
     * @return TransformerCollectionStage|null
     */
    private function createTransformerStage(
        TransformerCollectionInterface $transformer = null
    ) {
        if ($transformer === null) {
            return null;
        }

        return new TransformerCollectionStage($transformer);
    }
}
