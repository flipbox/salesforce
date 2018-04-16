<?php

/**
 * @copyright  Copyright (c) Flipbox Digital Limited
 * @license    https://github.com/flipbox/salesforce/blob/master/LICENSE.md
 * @link       https://github.com/flipbox/salesforce
 */

namespace Flipbox\Salesforce\Pipeline\Processors;

use Flipbox\Pipeline\Processors\SelectableStageProcessor;
use Flipbox\Skeleton\Helpers\JsonHelper;
use Psr\Http\Message\ResponseInterface;

/**
 * This processor will append a stage key based on the HTTP Response Status Code.  It is intended to
 * allow pre-processing of the HTTP Response (json_decode, etc), determine the next stage/pipeline and hand
 * off the payload for further (yet specific) data handling.  In the most basic form, it's used to handle
 * successful (200-299) response codes.
 *
 * @author Flipbox Factory <hello@flipboxfactory.com>
 * @since 1.0.0
 */
class HttpResponseProcessor extends SelectableStageProcessor
{
    /**
     * The stage key for 'successful' HTTP Response
     */
    const SUCCESS_KEY = 'response';

    /**
     * The stage key for 'error' HTTP Response
     */
    const ERROR_KEY = 'error';

    /**
     * @inheritdoc
     */
    public $processOnEmpty = true;

    /**
     * @inheritdoc
     */
    public function process(array $stages, $payload, $source = null)
    {
        if (!$this->payloadIsResponse($payload)) {
            return $payload;
        }

        if (null !== ($key = $this->lookupKey($payload))) {
            $this->keys[] = $this->lookupKey($payload);
        }

        return parent::process(
            $stages,
            $this->processPayload($payload),
            $source
        );
    }

    /**
     * @param ResponseInterface $response
     * @return array
     */
    protected function processPayload(ResponseInterface $response)
    {
        return JsonHelper::decodeIfJson(
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
            return self::SUCCESS_KEY;
        }

        return self::ERROR_KEY;
    }
}
