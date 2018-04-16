<?php

/**
 * @copyright  Copyright (c) Flipbox Digital Limited
 * @license    https://github.com/flipbox/salesforce/blob/master/LICENSE.md
 * @link       https://github.com/flipbox/salesforce
 */

namespace Flipbox\Salesforce;

use Flipbox\Skeleton\Logger\StaticLoggerTrait;
use Psr\Log\LoggerInterface;

/**
 * @author Flipbox Factory <hello@flipboxfactory.com>
 * @since 1.0.0
 */
class Salesforce
{
    use StaticLoggerTrait;

    /**
     * @var LoggerInterface
     */
    private static $logger;

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
