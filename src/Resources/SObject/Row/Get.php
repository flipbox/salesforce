<?php

/**
 * @copyright  Copyright (c) Flipbox Digital Limited
 * @license    https://github.com/flipbox/salesforce/blob/master/LICENSE.md
 * @link       https://github.com/flipbox/salesforce
 */

namespace Flipbox\Salesforce\Resources\SObject\Row;

use Flipbox\Relay\Runner\Runner;
use Flipbox\Relay\Salesforce\Builder\Resources\SObject\Row\Get as GetRelayBuilder;
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
class Get extends Resource
{
    /**
     * @param string $sObject
     * @param string $id
     * @param ConnectionInterface $connection
     * @param CacheItemPoolInterface $cache
     * @param TransformerCollectionInterface|null $transformers
     * @param LoggerInterface|null $logger
     * @param array $config
     */
    public function __construct(
        string $sObject,
        string $id,
        ConnectionInterface $connection,
        CacheItemPoolInterface $cache,
        TransformerCollectionInterface $transformers = null,
        LoggerInterface $logger = null,
        array $config = []
    ) {
        $logger = $logger ?: Salesforce::getLogger();

        parent::__construct(
            $this->createRelay($connection, $cache, $sObject, $id, $logger),
            $transformers,
            $logger,
            $config
        );
    }

    /**
     * @param ConnectionInterface $connection
     * @param CacheItemPoolInterface $cache
     * @param string $sobject
     * @param string $id
     * @param LoggerInterface|null $logger
     * @return Runner
     */
    private function createRelay(
        ConnectionInterface $connection,
        CacheItemPoolInterface $cache,
        string $sobject,
        string $id,
        LoggerInterface $logger = null
    ): Runner {
        return (new GetRelayBuilder(
            $connection,
            $connection,
            $cache,
            $sobject,
            $id,
            $logger
        ))->build();
    }
}
