<?php

/**
 * @copyright  Copyright (c) Flipbox Digital Limited
 * @license    https://github.com/flipbox/salesforce/blob/master/LICENSE.md
 * @link       https://github.com/flipbox/salesforce
 */

namespace Flipbox\Salesforce\Resources;

use Flipbox\Relay\Salesforce\Builder\Resources\Search as SearchBuilder;
use Flipbox\Salesforce\Connections\ConnectionInterface;
use Flipbox\Salesforce\Salesforce;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use Psr\SimpleCache\CacheInterface;

/**
 * @author Flipbox Factory <hello@flipboxfactory.com>
 * @since 3.0.0
 */
class Search
{
    /**
     * The resource name
     */
    const SALESFORCE_RESOURCE = 'search';

    /*******************************************
     * QUERY
     *******************************************/

    /**
     * @param ConnectionInterface|null $connection
     * @param CacheInterface|null $cache
     * @param string $search
     * @param LoggerInterface|null $logger
     * @param array $config
     * @return ResponseInterface
     */
    public static function search(
        string $search,
        ConnectionInterface $connection = null,
        CacheInterface $cache = null,
        LoggerInterface $logger = null,
        array $config = []
    ): ResponseInterface {
        return static::searchRelay(
            $search,
            $connection,
            $cache,
            $logger,
            $config
        )();
    }

    /**
     * @param ConnectionInterface|null $connection
     * @param CacheInterface|null $cache
     * @param string $search
     * @param LoggerInterface|null $logger
     * @param array $config
     * @return callable
     */
    public static function searchRelay(
        string $search,
        ConnectionInterface $connection = null,
        CacheInterface $cache = null,
        LoggerInterface $logger = null,
        array $config = []
    ): callable {
        $connection = $connection ?: Salesforce::getConnection();

        $builder = new SearchBuilder(
            $connection,
            $connection,
            $cache ?: Salesforce::getCache(),
            $search,
            $logger ?: Salesforce::getLogger(),
            $config
        );

        return $builder->build();
    }
}
