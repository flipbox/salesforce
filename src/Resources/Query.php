<?php

/**
 * @copyright  Copyright (c) Flipbox Digital Limited
 * @license    https://github.com/flipbox/salesforce/blob/master/LICENSE.md
 * @link       https://github.com/flipbox/salesforce
 */

namespace Flipbox\Salesforce\Resources;

use Flipbox\Relay\Salesforce\Builder\Resources\Query as QueryBuilder;
use Flipbox\Salesforce\Connections\ConnectionInterface;
use Flipbox\Salesforce\Salesforce;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use Psr\SimpleCache\CacheInterface;

/**
 * @author Flipbox Factory <hello@flipboxfactory.com>
 * @since 3.0.0
 */
class Query
{
    /**
     * The resource name
     */
    const SALESFORCE_RESOURCE = 'query';


    /*******************************************
     * QUERY
     *******************************************/

    /**
     * @param ConnectionInterface $connection
     * @param CacheInterface $cache
     * @param string $query
     * @param LoggerInterface|null $logger
     * @param array $config
     * @return ResponseInterface
     */
    public static function query(
        ConnectionInterface $connection,
        CacheInterface $cache,
        string $query,
        LoggerInterface $logger = null,
        array $config = []
    ): ResponseInterface {
        return static::queryRelay(
            $connection,
            $cache,
            $query,
            $logger,
            $config
        )();
    }

    /**
     * @param ConnectionInterface $connection
     * @param CacheInterface $cache
     * @param string $query
     * @param LoggerInterface|null $logger
     * @param array $config
     * @return callable
     */
    public static function queryRelay(
        ConnectionInterface $connection,
        CacheInterface $cache,
        string $query,
        LoggerInterface $logger = null,
        array $config = []
    ): callable {
        $builder = new QueryBuilder(
            $connection,
            $connection,
            $cache,
            $query,
            $logger ?: Salesforce::getLogger(),
            $config
        );

        return $builder->build();
    }
}
