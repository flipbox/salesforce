<?php

/**
 * @copyright  Copyright (c) Flipbox Digital Limited
 * @license    https://github.com/flipbox/salesforce/blob/master/LICENSE.md
 * @link       https://github.com/flipbox/salesforce
 */

namespace Flipbox\Salesforce\Resources;

use Flipbox\Relay\Builder\RelayBuilderInterface;
use Flipbox\Relay\Salesforce\Builder\Resources\Describe;
use Flipbox\Relay\Salesforce\Builder\Resources\Limits;
use Flipbox\Relay\Salesforce\Builder\Resources\Resources;
use Flipbox\Salesforce\Connections\ConnectionInterface;
use Flipbox\Salesforce\Salesforce;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use Psr\SimpleCache\CacheInterface;

/**
 * @author Flipbox Factory <hello@flipboxfactory.com>
 * @since 3.0.0
 */
class Instance
{

    /**
     * The resource name
     */
    const SALESFORCE_RESOURCE = 'instance';

    /*******************************************
     * DESCRIBE
     *******************************************/

    /**
     * @param ConnectionInterface $connection
     * @param CacheInterface $cache
     * @param LoggerInterface $logger
     * @param array $config
     * @return ResponseInterface
     */
    public static function describe(
        ConnectionInterface $connection,
        CacheInterface $cache,
        LoggerInterface $logger = null,
        array $config = []
    ): ResponseInterface
    {
        return static::describeRelay(
            $connection,
            $cache,
            $logger,
            $config
        )();
    }

    /**
     * @param ConnectionInterface $connection
     * @param CacheInterface $cache
     * @param LoggerInterface $logger
     * @param array $config
     * @return callable
     */
    public static function describeRelay(
        ConnectionInterface $connection,
        CacheInterface $cache,
        LoggerInterface $logger = null,
        array $config = []
    ): callable
    {
        /** @var RelayBuilderInterface $builder */
        $builder = new Describe(
            $connection,
            $connection,
            $cache,
            $logger ?: Salesforce::getLogger(),
            $config
        );

        return $builder->build();
    }

    /*******************************************
     * LIMITS
     *******************************************/

    /**
     * @param ConnectionInterface $connection
     * @param CacheInterface $cache
     * @param LoggerInterface|null $logger
     * @param array $config
     * @return callable
     */
    public static function limitsRelay(
        ConnectionInterface $connection,
        CacheInterface $cache,
        LoggerInterface $logger = null,
        array $config = []
    ): callable
    {
        /** @var RelayBuilderInterface $builder */
        $builder = new Limits(
            $connection,
            $connection,
            $cache,
            $logger ?: Salesforce::getLogger(),
            $config
        );

        return $builder->build();
    }

    /**
     * @param ConnectionInterface $connection
     * @param CacheInterface $cache
     * @param LoggerInterface|null $logger
     * @param array $config
     * @return ResponseInterface
     */
    public static function limits(
        ConnectionInterface $connection,
        CacheInterface $cache,
        LoggerInterface $logger = null,
        array $config = []
    ): ResponseInterface
    {
        return static::limitsRelay(
            $connection,
            $cache,
            $logger,
            $config
        )();
    }

    /*******************************************
     * RESOURCES
     *******************************************/

    /**
     * @param ConnectionInterface $connection
     * @param CacheInterface $cache
     * @param LoggerInterface|null $logger
     * @param array $config
     * @return callable
     */
    public static function resourcesRelay(
        ConnectionInterface $connection,
        CacheInterface $cache,
        LoggerInterface $logger = null,
        array $config = []
    ): callable
    {
        /** @var RelayBuilderInterface $builder */
        $builder = new Resources(
            $connection,
            $connection,
            $cache,
            $logger ?: Salesforce::getLogger(),
            $config
        );

        return $builder->build();
    }

    /**
     * @param ConnectionInterface $connection
     * @param CacheInterface $cache
     * @param LoggerInterface|null $logger
     * @param array $config
     * @return ResponseInterface
     */
    public static function resources(
        ConnectionInterface $connection,
        CacheInterface $cache,
        LoggerInterface $logger = null,
        array $config = []
    ): ResponseInterface
    {
        return static::resourcesRelay(
            $connection,
            $cache,
            $logger,
            $config
        )();
    }
}
