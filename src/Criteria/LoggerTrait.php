<?php

/**
 * @copyright  Copyright (c) Flipbox Digital Limited
 * @license    https://github.com/flipbox/salesforce/blob/master/LICENSE.md
 * @link       https://github.com/flipbox/salesforce
 */

namespace Flipbox\Salesforce\Criteria;

use Psr\Log\LoggerInterface;

/**
 * @author Flipbox Factory <hello@flipboxfactory.com>
 * @since 3.3.0
 */
trait LoggerTrait
{
    /**
     * @var LoggerInterface|string|null
     */
    protected $logger;

    /**
     * @param $value
     * @return $this
     */
    public function logger($value)
    {
        return $this->setLogger($value);
    }

    /**
     * @param $value
     * @return $this
     */
    public function setLogger($value)
    {
        $this->logger = $value;
        return $this;
    }

    /**
     * @return LoggerInterface|null
     */
    public function getLogger()
    {
        return $this->logger;
    }
}
