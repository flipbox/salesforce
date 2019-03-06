<?php

/**
 * @copyright  Copyright (c) Flipbox Digital Limited
 * @license    https://github.com/flipbox/salesforce/blob/master/LICENSE.md
 * @link       https://github.com/flipbox/salesforce
 */

namespace Flipbox\Salesforce;

use Flipbox\Salesforce\Connections\ConnectionInterface;
use Flipbox\Skeleton\Logger\StaticLoggerTrait;
use Psr\Log\LoggerInterface;
use Psr\SimpleCache\CacheInterface;

/**
 * @author Flipbox Factory <hello@flipboxfactory.com>
 * @since 3.0.0
 */
class Salesforce
{
    use StaticLoggerTrait;

    /**
     * @var CacheInterface
     */
    private static $cache;

    /**
     * @var ConnectionInterface
     */
    private static $connection;

    /**
     * @var LoggerInterface
     */
    private static $logger;


    /*******************************************
     * CACHE
     *******************************************/

    /**
     * Get the cache
     *
     * @return CacheInterface
     */
    public static function getCache(): CacheInterface
    {
        return self::$cache;
    }

    /**
     * Set the cache
     *
     * @param CacheInterface $cache
     */
    public static function setCache(CacheInterface $cache)
    {
        self::$cache = $cache;
    }


    /*******************************************
     * CONNECTION
     *******************************************/

    /**
     * Get the connection
     *
     * @return ConnectionInterface
     */
    public static function getConnection(): ConnectionInterface
    {
        return self::$connection;
    }

    /**
     * Set the connection
     *
     * @param ConnectionInterface $connection
     */
    public static function setConnection(ConnectionInterface $connection)
    {
        self::$connection = $connection;
    }


    /*******************************************
     * LOGGER
     *******************************************/

    /**
     * Get a logger
     *
     * @return LoggerInterface|null
     */
    public static function getLogger()
    {
        return self::$logger;
    }

    /**
     * Set a logger
     *
     * @param LoggerInterface|null $logger
     */
    public static function setLogger(LoggerInterface $logger = null)
    {
        self::$logger = $logger;
    }

    /**
     * Logs with an arbitrary level.
     *
     * @param mixed $level
     * @param string $message
     * @param array $context
     *
     */
    public static function log($level, $message, array $context = [])
    {
        if (null !== ($logger = static::getLogger())) {
            $logger->log($level, $message, $context);
        }
    }
}
