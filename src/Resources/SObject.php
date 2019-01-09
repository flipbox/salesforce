<?php

/**
 * @copyright  Copyright (c) Flipbox Digital Limited
 * @license    https://github.com/flipbox/salesforce/blob/master/LICENSE.md
 * @link       https://github.com/flipbox/salesforce
 */

namespace Flipbox\Salesforce\Resources;

use Flipbox\Relay\Builder\RelayBuilderInterface;
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
     * @return callable
     */
    public static function basicRelay(
        ConnectionInterface $connection,
        CacheInterface $cache,
        string $object,
        LoggerInterface $logger = null,
        array $config = []
    ): callable {
        /** @var RelayBuilderInterface $builder */
        $builder = new Basic(
            $connection,
            $connection,
            $cache,
            $object,
            $logger ?: Salesforce::getLogger(),
            $config
        );

        return $builder->build();
    }


    /**
     * @param ConnectionInterface $connection
     * @param CacheInterface $cache
     * @param string $object
     * @param LoggerInterface|null $logger
     * @param array $config
     * @return ResponseInterface
     */
    public static function basic(
        ConnectionInterface $connection,
        CacheInterface $cache,
        string $object,
        LoggerInterface $logger = null,
        array $config = []
    ): ResponseInterface {
        return static::basicRelay(
            $connection,
            $cache,
            $object,
            $logger,
            $config
        )();
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
        ConnectionInterface $connection,
        CacheInterface $cache,
        string $object,
        LoggerInterface $logger = null,
        array $config = []
    ): ResponseInterface {
        return static::describeRelay(
            $connection,
            $cache,
            $object,
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
        ConnectionInterface $connection,
        CacheInterface $cache,
        string $object,
        LoggerInterface $logger = null,
        array $config = []
    ): callable {
        /** @var RelayBuilderInterface $builder */
        $builder = new Describe(
            $connection,
            $connection,
            $cache,
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
        ConnectionInterface $connection,
        string $object,
        array $payload,
        LoggerInterface $logger = null,
        array $config = []
    ): ResponseInterface {
        return static::createRelay(
            $connection,
            $object,
            $payload,
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
        ConnectionInterface $connection,
        string $object,
        array $payload,
        LoggerInterface $logger = null,
        array $config = []
    ): callable {

        /** @var RelayBuilderInterface $builder */
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
        ConnectionInterface $connection,
        CacheInterface $cache,
        string $object,
        string $id,
        LoggerInterface $logger = null,
        array $config = []
    ): ResponseInterface {
        return static::readRelay(
            $connection,
            $cache,
            $object,
            $id,
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
        ConnectionInterface $connection,
        CacheInterface $cache,
        string $object,
        string $id,
        LoggerInterface $logger = null,
        array $config = []
    ): callable {
        /** @var RelayBuilderInterface $builder */
        $builder = new Get(
            $connection,
            $connection,
            $cache,
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
        ConnectionInterface $connection,
        CacheInterface $cache,
        string $object,
        array $payload,
        string $id,
        LoggerInterface $logger = null,
        array $config = []
    ): ResponseInterface {
        return static::updateRelay(
            $connection,
            $cache,
            $object,
            $payload,
            $id,
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
        ConnectionInterface $connection,
        CacheInterface $cache,
        string $object,
        array $payload,
        string $id,
        LoggerInterface $logger = null,
        array $config = []
    ): callable {
        /** @var RelayBuilderInterface $builder */
        $builder = new Update(
            $connection,
            $connection,
            $cache,
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
     * @return callable
     */
    public static function upsertRelay(
        ConnectionInterface $connection,
        CacheInterface $cache,
        string $object,
        array $payload,
        string $id = null,
        LoggerInterface $logger = null,
        array $config = []
    ): callable {

        /** @var RelayBuilderInterface $builder */
        $builder = new Upsert(
            $connection,
            $connection,
            $cache,
            $object,
            $payload,
            empty($id) ? null : $id,
            $logger ?: Salesforce::getLogger(),
            $config
        );

        return $builder->build();
    }

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
        ConnectionInterface $connection,
        CacheInterface $cache,
        string $object,
        array $payload,
        string $id = null,
        LoggerInterface $logger = null,
        array $config = []
    ): ResponseInterface {
        return static::upsertRelay(
            $connection,
            $cache,
            $object,
            $payload,
            $id,
            $logger,
            $config
        )();
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
        ConnectionInterface $connection,
        CacheInterface $cache,
        string $object,
        string $id,
        LoggerInterface $logger = null,
        array $config = []
    ): ResponseInterface {
        return static::deleteRelay(
            $connection,
            $cache,
            $object,
            $id,
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
        ConnectionInterface $connection,
        CacheInterface $cache,
        string $object,
        string $id,
        LoggerInterface $logger = null,
        array $config = []
    ): callable {
        /** @var RelayBuilderInterface $builder */
        $builder = new Delete(
            $connection,
            $connection,
            $cache,
            $object,
            $id,
            $logger ?: Salesforce::getLogger(),
            $config
        );

        return $builder->build();
    }
}
