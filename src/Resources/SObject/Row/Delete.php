<?php

/**
 * @copyright  Copyright (c) Flipbox Digital Limited
 * @license    https://github.com/flipbox/salesforce/blob/master/LICENSE.md
 * @link       https://github.com/flipbox/salesforce
 */

namespace Flipbox\Salesforce\Resources\SObject\Row;

use Flipbox\Relay\Runner\Runner;
use Flipbox\Relay\Salesforce\Builder\Resources\SObject\Row\Delete as DeleteRelayBuilder;
use Flipbox\Salesforce\Connections\ConnectionInterface;
use Flipbox\Salesforce\Resources\Resource;
use Flipbox\Salesforce\Salesforce;
use Flipbox\Salesforce\Transformers\Collections\TransformerCollectionInterface;
use Psr\Log\LoggerInterface;
use Psr\SimpleCache\CacheInterface;

/**
 * @author Flipbox Factory <hello@flipboxfactory.com>
 * @since 1.0.0
 */
class Delete extends Resource
{
    /**
     * @param string $sObject
     * @param string $id
     * @param ConnectionInterface $connection
     * @param CacheInterface $cache
     * @param TransformerCollectionInterface|null $transformers
     * @param LoggerInterface|null $logger
     * @param array $config
     */
    public function __construct(
        string $sObject,
        string $id,
        ConnectionInterface $connection,
        CacheInterface $cache,
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
     * @param CacheInterface $cache
     * @param string $sobject
     * @param string $id
     * @param LoggerInterface|null $logger
     * @return Runner
     */
    private function createRelay(
        ConnectionInterface $connection,
        CacheInterface $cache,
        string $sobject,
        string $id,
        LoggerInterface $logger = null
    ): Runner {
        return (new DeleteRelayBuilder(
            $connection,
            $connection,
            $cache,
            $sobject,
            $id,
            $logger
        ))->build();
    }
}
