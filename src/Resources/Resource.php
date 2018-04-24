<?php

/**
 * @copyright  Copyright (c) Flipbox Digital Limited
 * @license    https://github.com/flipbox/salesforce/blob/master/LICENSE.md
 * @link       https://github.com/flipbox/salesforce
 */

namespace Flipbox\Salesforce\Resources;

use Flipbox\Relay\Runner\Runner;
use Flipbox\Salesforce\Pipeline\Pipelines\HttpResponseTransformerPipeline;
use Flipbox\Salesforce\Pipeline\Processors\HttpResponseProcessor;
use Flipbox\Salesforce\Pipeline\Stages\Transformers\Item;
use Flipbox\Salesforce\Salesforce;
use Flipbox\Salesforce\Transformers\Collections\TransformerCollectionInterface;
use Psr\Log\LoggerInterface;

/**
 * A Relay pipeline builder intended to make building the Relay and Pipeline easier.
 *
 * @author Flipbox Factory <hello@flipboxfactory.com>
 * @since 1.0.0
 */
class Resource extends AbstractResource
{
    /**
     * @var array
     */
    public $responseTransformers = [
        HttpResponseProcessor::ERROR_KEY => Item::class,
        HttpResponseProcessor::SUCCESS_KEY => Item::class
    ];

    /**
     * @param Runner $runner
     * @param TransformerCollectionInterface|null $transformers
     * @param LoggerInterface|null $logger
     * @param array $config
     */
    public function __construct(
        Runner $runner,
        TransformerCollectionInterface $transformers = null,
        LoggerInterface $logger = null,
        array $config = []
    ) {
        $logger = $logger ?: Salesforce::getLogger();

        parent::__construct(
            $runner,
            $this->buildDataPipeline($transformers),
            $logger
        );
    }

    /**
     * @param TransformerCollectionInterface $transformers
     * @return HttpResponseTransformerPipeline
     */
    protected function buildDataPipeline(TransformerCollectionInterface $transformers = null
    ): HttpResponseTransformerPipeline {
        $stages = [];
        foreach ($this->responseTransformers as $key => $stage) {
            if (null === $transformers ||
                null === ($transformer = $transformers->getTransformer($key))
            ) {
                continue;
            }

            $stages[$key] = [
                'class' => $stage,
                'transformer' => $transformer
            ];
        }

        return new HttpResponseTransformerPipeline(['stages' => $stages]);
    }
}
