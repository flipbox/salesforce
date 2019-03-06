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
     * @param string $query
     * @param ConnectionInterface|null $connection
     * @param CacheInterface|null $cache
     * @param LoggerInterface|null $logger
     * @param array $config
     * @return ResponseInterface
     */
    public static function query(
        string $query,
        ConnectionInterface $connection = null,
        CacheInterface $cache = null,
        LoggerInterface $logger = null,
        array $config = []
    ): ResponseInterface {
        return static::queryRelay(
            $query,
            $connection,
            $cache,
            $logger,
            $config
        )();
    }

    /**
     * @param string $query
     * @param ConnectionInterface $connection
     * @param CacheInterface $cache
     * @param LoggerInterface|null $logger
     * @param array $config
     * @return callable
     */
    public static function queryRelay(
        string $query,
        ConnectionInterface $connection = null,
        CacheInterface $cache = null,
        LoggerInterface $logger = null,
        array $config = []
    ): callable {
        $connection = $connection ?: Salesforce::getConnection();

        $builder = new QueryBuilder(
            $connection,
            $connection,
            $cache ?: Salesforce::getCache(),
            $query,
            $logger ?: Salesforce::getLogger(),
            $config
        );

        return $builder->build();
    }
}
