<?php

/**
 * @copyright  Copyright (c) Flipbox Digital Limited
 * @license    https://github.com/flipbox/salesforce/blob/master/LICENSE.md
 * @link       https://github.com/flipbox/salesforce
 */

namespace Flipbox\Salesforce\Criteria;

use Flipbox\Salesforce\Connections\ConnectionInterface;
use Flipbox\Salesforce\Salesforce;

/**
 * @author Flipbox Factory <hello@flipboxfactory.com>
 * @since 3.3.0
 */
trait ConnectionTrait
{
    /**
     * @var ConnectionInterface|null
     */
    protected $connection;

    /**
     * @param $value
     * @return $this
     */
    public function connection($value)
    {
        return $this->setConnection($value);
    }

    /**
     * @param $value
     * @return $this
     */
    public function setConnection($value)
    {
        $this->connection = $value;
        return $this;
    }

    /**
     * @return ConnectionInterface
     */
    public function getConnection(): ConnectionInterface
    {
        return $this->connection = $this->resolveConnection($this->connection);
    }

    /**
     * @param $connection
     * @return ConnectionInterface
     */
    protected function resolveConnection($connection)
    {
        if ($connection instanceof ConnectionInterface) {
            return $connection;
        }

        return Salesforce::getConnection();
    }
}
