<?php

/**
 * @copyright  Copyright (c) Flipbox Digital Limited
 * @license    https://github.com/flipbox/salesforce/blob/master/LICENSE.md
 * @link       https://github.com/flipbox/salesforce
 */

namespace Flipbox\Salesforce\Pipeline\Stages;

use Flipbox\Salesforce\Transformers\Collections\TransformerCollectionInterface;
use Flipbox\Skeleton\Helpers\JsonHelper;
use Flipbox\Skeleton\Logger\AutoLoggerTrait;
use Flipbox\Transform\Factory;
use League\Pipeline\StageInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * This stage will resolve a transformer based on the HTTP Response Status Code.  It is intended to
 * allow pre-processing of the HTTP Response (json_decode, etc), determine the transformer and process
 * the payload.  In the most basic form, it's used to handle successful (200-299) response codes and
 * error (non 200-299) response codes.
 *
 * @author Flipbox Factory <hello@flipboxfactory.com>
 * @since 1.0.0
 */
class TransformerCollectionStage implements StageInterface
{
    use AutoLoggerTrait;

    /**
     * @var TransformerCollectionInterface|null
     */
    private $collection;

    /**
     * @param TransformerCollectionInterface $collection
     */
    public function __construct(TransformerCollectionInterface $collection)
    {
        $this->collection = $collection;
    }

    /**
     * @param mixed $payload
     * @param null $source
     * @return array|mixed|null
     */
    public function __invoke($payload, $source = null)
    {
        if (!$this->payloadIsResponse($payload)) {
            return $payload;
        }

        if (null === ($key = $this->lookupKey($payload))) {
            return $this->processPayload($payload);
        }

        if (null === ($transformer = $this->collection->getTransformer($key))) {
            return $this->processPayload($payload);
        }

        return Factory::Item(
            $transformer,
            $this->processPayload($payload),
            [],
            ['source' => $source]
        );
    }

    /**
     * @param ResponseInterface $response
     * @return array
     */
    protected function processPayload(ResponseInterface $response): array
    {
        return (array)JsonHelper::decodeIfJson(
            $response->getBody()->getContents()
        );
    }

    /**
     * @param $payload
     * @return bool
     */
    protected function payloadIsResponse($payload): bool
    {
        return $payload instanceof ResponseInterface;
    }

    /**
     * @param ResponseInterface $response
     * @return string|null
     */
    protected function lookupKey(ResponseInterface $response)
    {
        if ($response->getStatusCode() >= 200 &&
            $response->getStatusCode() < 300
        ) {
            return TransformerCollectionInterface::SUCCESS_KEY;
        }

        return TransformerCollectionInterface::ERROR_KEY;
    }
}