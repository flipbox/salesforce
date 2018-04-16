<?php

/**
 * @copyright  Copyright (c) Flipbox Digital Limited
 * @license    https://github.com/flipbox/salesforce/blob/master/LICENSE.md
 * @link       https://github.com/flipbox/salesforce
 */

namespace Flipbox\Salesforce\Resources\SObject\Row;

use Flipbox\Relay\Runner\Runner;
use Flipbox\Relay\Salesforce\Builder\Resources\SObject\Row\Upsert as UpsertRelayBuilder;
use Flipbox\Salesforce\Connections\ConnectionInterface;
use Flipbox\Salesforce\Resources\Resource;
use Flipbox\Salesforce\Salesforce;
use Flipbox\Salesforce\Transformers\Collections\TransformerCollectionInterface;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Log\LoggerInterface;

/**
 * @author Flipbox Factory <hello@flipboxfactory.com>
 * @since 1.0.0
 */
class Upsert extends Resource
{
    /**
     * @param string $sObject
     * @param array $payload
     * @param ConnectionInterface $connection
     * @param CacheItemPoolInterface $cache
     * @param string|null $id
     * @param TransformerCollectionInterface $transformers = null
     * @param LoggerInterface|null $logger
     * @param array $config
     */
    public function __construct(
        string $sObject,
        array $payload,
        ConnectionInterface $connection,
        CacheItemPoolInterface $cache,
        string $id = null,
        TransformerCollectionInterface $transformers = null,
        LoggerInterface $logger = null,
        array $config = []
    ) {
        $logger = $logger ?: Salesforce::getLogger();

        parent::__construct(
            $this->createStage($connection, $cache, $sObject, $payload, $id, $logger),
            $transformers,
            $logger,
            $config
        );
    }

    /**
     * @param ConnectionInterface $connection
     * @param CacheItemPoolInterface $cache
     * @param string $sobject
     * @param array $payload
     * @param string|null $id
     * @param LoggerInterface|null $logger
     * @return Runner
     */
    private function createStage(
        ConnectionInterface $connection,
        CacheItemPoolInterface $cache,
        string $sobject,
        array $payload,
        string $id = null,
        LoggerInterface $logger = null
    ): Runner {
        return (new UpsertRelayBuilder(
            $connection,
            $connection,
            $cache,
            $sobject,
            $payload,
            $id,
            $logger
        ))->build();
    }
}
