<?php

/**
 * @copyright  Copyright (c) Flipbox Digital Limited
 * @license    https://github.com/flipbox/salesforce/blob/master/LICENSE.md
 * @link       https://github.com/flipbox/salesforce
 */

namespace Flipbox\Salesforce\Resources;

use Flipbox\Relay\Runner\Runner;
use Flipbox\Relay\Salesforce\Builder\Resources\Describe as DescribeRelayBuilder;
use Flipbox\Salesforce\Connections\ConnectionInterface;
use Flipbox\Salesforce\Salesforce;
use Flipbox\Salesforce\Transformers\Collections\TransformerCollectionInterface;
use Psr\Log\LoggerInterface;
use Psr\SimpleCache\CacheInterface;

/**
 * @author Flipbox Factory <hello@flipboxfactory.com>
 * @since 1.0.0
 */
class Describe extends Resource
{
    /**
     * @param ConnectionInterface $connection
     * @param CacheInterface $cache
     * @param TransformerCollectionInterface|null $transformers
     * @param LoggerInterface|null $logger
     * @param array $config
     */
    public function __construct(
        ConnectionInterface $connection,
        CacheInterface $cache,
        TransformerCollectionInterface $transformers = null,
        LoggerInterface $logger = null,
        array $config = []
    ) {
        $logger = $logger ?: Salesforce::getLogger();

        parent::__construct(
            $this->createRelay($connection, $cache, $logger),
            $transformers,
            $logger,
            $config
        );
    }

    /**
     * @param ConnectionInterface $connection
     * @param CacheInterface $cache
     * @param LoggerInterface|null $logger
     * @return Runner
     */
    private function createRelay(
        ConnectionInterface $connection,
        CacheInterface $cache,
        LoggerInterface $logger = null
    ): Runner {
        return (new DescribeRelayBuilder(
            $connection,
            $connection,
            $cache,
            $logger
        ))->build();
    }
}
