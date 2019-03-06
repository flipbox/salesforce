<?php

/**
 * @copyright  Copyright (c) Flipbox Digital Limited
 * @license    https://github.com/flipbox/salesforce/blob/master/LICENSE.md
 * @link       https://github.com/flipbox/salesforce
 */

namespace Flipbox\Salesforce\Resources;

use Flipbox\Relay\Salesforce\Builder\Resources\SObject\Basic;
use Flipbox\Relay\Salesforce\Builder\Resources\SObject\Describe;
use Flipbox\Relay\Salesforce\Builder\Resources\SObject\Row\Create;
use Flipbox\Relay\Salesforce\Builder\Resources\SObject\Row\Delete;
use Flipbox\Relay\Salesforce\Builder\Resources\SObject\Row\Get;
use Flipbox\Relay\Salesforce\Builder\Resources\SObject\Row\Update;
use Flipbox\Relay\Salesforce\Builder\Resources\SObject\Row\Upsert;
use Flipbox\Salesforce\Connections\ConnectionInterface;
use Flipbox\Salesforce\Salesforce;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use Psr\SimpleCache\CacheInterface;

/**
 * @author Flipbox Factory <hello@flipboxfactory.com>
 * @since 3.0.0
 */
class SObject
{

    /**
     * The resource name
     */
    const SALESFORCE_RESOURCE = 'object';


    /*******************************************
     * BASIC
     *******************************************/

    /**
     * @param ConnectionInterface $connection
     * @param CacheInterface $cache
     * @param string $object
     * @param LoggerInterface|null $logger
     * @param array $config
     * @return ResponseInterface
     */
    public static function basic(
        string $object,
        ConnectionInterface $connection = null,
        CacheInterface $cache = null,
        LoggerInterface $logger = null,
        array $config = []
    ): ResponseInterface {
        return static::basicRelay(
            $object,
            $connection,
            $cache,
            $logger,
            $config
        )();
    }

    /**
     * @param ConnectionInterface $connection
     * @param CacheInterface $cache
     * @param string $object
     * @param LoggerInterface|null $logger
     * @param array $config
     * @return callable
     */
    public static function basicRelay(
        string $object,
        ConnectionInterface $connection = null,
        CacheInterface $cache = null,
        LoggerInterface $logger = null,
        array $config = []
    ): callable {
        $connection = $connection ?: Salesforce::getConnection();

        $builder = new Basic(
            $connection,
            $connection,
            $cache ?: Salesforce::getCache(),
            $object,
            $logger ?: Salesforce::getLogger(),
            $config
        );

        return $builder->build();
    }

    /*******************************************
     * DESCRIBE
     *******************************************/

    /**
     * @param string $object
     * @param ConnectionInterface $connection
     * @param CacheInterface $cache
     * @param LoggerInterface $logger
     * @param array $config
     * @return ResponseInterface
     */
    public static function describe(
        string $object,
        ConnectionInterface $connection = null,
        CacheInterface $cache = null,
        LoggerInterface $logger = null,
        array $config = []
    ): ResponseInterface {
        return static::describeRelay(
            $object,
            $connection,
            $cache,
            $logger,
            $config
        )();
    }

    /**
     * @param string $object
     * @param ConnectionInterface $connection
     * @param CacheInterface $cache
     * @param LoggerInterface $logger
     * @param array $config
     * @return callable
     */
    public static function describeRelay(
        string $object,
        ConnectionInterface $connection = null,
        CacheInterface $cache = null,
        LoggerInterface $logger = null,
        array $config = []
    ): callable {
        $connection = $connection ?: Salesforce::getConnection();

        $builder = new Describe(
            $connection,
            $connection,
            $cache ?: Salesforce::getCache(),
            $object,
            $logger ?: Salesforce::getLogger(),
            $config
        );

        return $builder->build();
    }


    /*******************************************
     * CREATE
     *******************************************/

    /**
     * @param string $object
     * @param array $payload
     * @param ConnectionInterface $connection
     * @param LoggerInterface $logger
     * @param array $config
     * @return ResponseInterface
     */
    public static function create(
        string $object,
        array $payload,
        ConnectionInterface $connection = null,
        LoggerInterface $logger = null,
        array $config = []
    ): ResponseInterface {
        return static::createRelay(
            $object,
            $payload,
            $connection,
            $logger,
            $config
        )();
    }

    /**
     * @param string $object
     * @param array $payload
     * @param ConnectionInterface $connection
     * @param LoggerInterface $logger
     * @param array $config
     * @return callable
     */
    public static function createRelay(
        string $object,
        array $payload,
        ConnectionInterface $connection = null,
        LoggerInterface $logger = null,
        array $config = []
    ): callable {
        $connection = $connection ?: Salesforce::getConnection();

        $builder = new Create(
            $connection,
            $connection,
            $object,
            $payload,
            $logger ?: Salesforce::getLogger(),
            $config
        );

        return $builder->build();
    }


    /*******************************************
     * READ
     *******************************************/

    /**
     * @param ConnectionInterface $connection
     * @param CacheInterface $cache
     * @param string $object
     * @param string $id
     * @param LoggerInterface|null $logger
     * @param array $config
     * @return ResponseInterface
     */
    public static function read(
        string $object,
        string $id,
        ConnectionInterface $connection = null,
        CacheInterface $cache = null,
        LoggerInterface $logger = null,
        array $config = []
    ): ResponseInterface {
        return static::readRelay(
            $object,
            $id,
            $connection,
            $cache,
            $logger,
            $config
        )();
    }

    /**
     * @param ConnectionInterface $connection
     * @param CacheInterface $cache
     * @param string $object
     * @param string $id
     * @param LoggerInterface|null $logger
     * @param array $config
     * @return callable
     */
    public static function readRelay(
        string $object,
        string $id,
        ConnectionInterface $connection = null,
        CacheInterface $cache = null,
        LoggerInterface $logger = null,
        array $config = []
    ): callable {
        $connection = $connection ?: Salesforce::getConnection();

        $builder = new Get(
            $connection,
            $connection,
            $cache ?: Salesforce::getCache(),
            $object,
            $id,
            $logger ?: Salesforce::getLogger(),
            $config
        );

        return $builder->build();
    }

    /*******************************************
     * UPDATE
     *******************************************/

    /**
     * @param string $object
     * @param string $id
     * @param array $payload
     * @param ConnectionInterface $connection
     * @param CacheInterface $cache
     * @param LoggerInterface|null $logger
     * @param array $config
     * @return ResponseInterface
     */
    public static function update(
        string $object,
        array $payload,
        string $id,
        ConnectionInterface $connection = null,
        CacheInterface $cache = null,
        LoggerInterface $logger = null,
        array $config = []
    ): ResponseInterface {
        return static::updateRelay(
            $object,
            $payload,
            $id,
            $connection,
            $cache,
            $logger,
            $config
        )();
    }

    /**
     * @param string $object
     * @param string $id
     * @param array $payload
     * @param ConnectionInterface $connection
     * @param CacheInterface $cache
     * @param LoggerInterface|null $logger
     * @param array $config
     * @return callable
     */
    public static function updateRelay(
        string $object,
        array $payload,
        string $id,
        ConnectionInterface $connection = null,
        CacheInterface $cache = null,
        LoggerInterface $logger = null,
        array $config = []
    ): callable {
        $connection = $connection ?: Salesforce::getConnection();

        $builder = new Update(
            $connection,
            $connection,
            $cache ?: Salesforce::getCache(),
            $object,
            $payload,
            $id,
            $logger ?: Salesforce::getLogger(),
            $config
        );

        return $builder->build();
    }


    /*******************************************
     * UPSERT
     *******************************************/

    /**
     * @param ConnectionInterface $connection
     * @param CacheInterface $cache
     * @param string $object
     * @param array $payload
     * @param string|null $id
     * @param LoggerInterface|null $logger
     * @param array $config
     * @return ResponseInterface
     */
    public static function upsert(
        string $object,
        array $payload,
        string $id = null,
        ConnectionInterface $connection = null,
        CacheInterface $cache = null,
        LoggerInterface $logger = null,
        array $config = []
    ): ResponseInterface {
        return static::upsertRelay(
            $object,
            $payload,
            $id,
            $connection,
            $cache,
            $logger,
            $config
        )();
    }

    /**
     * @param ConnectionInterface $connection
     * @param CacheInterface $cache
     * @param string $object
     * @param array $payload
     * @param string|null $id
     * @param LoggerInterface|null $logger
     * @param array $config
     * @return callable
     */
    public static function upsertRelay(
        string $object,
        array $payload,
        string $id = null,
        ConnectionInterface $connection = null,
        CacheInterface $cache = null,
        LoggerInterface $logger = null,
        array $config = []
    ): callable {
        $connection = $connection ?: Salesforce::getConnection();

        $builder = new Upsert(
            $connection,
            $connection,
            $cache ?: Salesforce::getCache(),
            $object,
            $payload,
            empty($id) ? null : $id,
            $logger ?: Salesforce::getLogger(),
            $config
        );

        return $builder->build();
    }


    /*******************************************
     * DELETE
     *******************************************/

    /**
     * @param string $object
     * @param string $id
     * @param ConnectionInterface $connection
     * @param CacheInterface $cache
     * @param LoggerInterface $logger
     * @param array $config
     * @return ResponseInterface
     */
    public static function delete(
        string $object,
        string $id,
        ConnectionInterface $connection = null,
        CacheInterface $cache = null,
        LoggerInterface $logger = null,
        array $config = []
    ): ResponseInterface {
        return static::deleteRelay(
            $object,
            $id,
            $connection,
            $cache,
            $logger,
            $config
        )();
    }

    /**
     * @param string $object
     * @param string $id
     * @param ConnectionInterface $connection
     * @param CacheInterface $cache
     * @param LoggerInterface $logger
     * @param array $config
     * @return callable
     */
    public static function deleteRelay(
        string $object,
        string $id,
        ConnectionInterface $connection = null,
        CacheInterface $cache = null,
        LoggerInterface $logger = null,
        array $config = []
    ): callable {
        $connection = $connection ?: Salesforce::getConnection();

        $builder = new Delete(
            $connection,
            $connection,
            $cache ?: Salesforce::getCache(),
            $object,
            $id,
            $logger ?: Salesforce::getLogger(),
            $config
        );

        return $builder->build();
    }
}
