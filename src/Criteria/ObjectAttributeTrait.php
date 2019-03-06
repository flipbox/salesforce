<?php

/**
 * @copyright  Copyright (c) Flipbox Digital Limited
 * @license    https://github.com/flipbox/salesforce/blob/master/LICENSE.md
 * @link       https://github.com/flipbox/salesforce
 */

namespace Flipbox\Salesforce\Criteria;

/**
 * @author Flipbox Factory <hello@flipboxfactory.com>
 * @since 3.3.0
 */
trait ObjectAttributeTrait
{
    /**
     * @var string|null
     */
    protected $object;

    /**
     * @return string
     * @throws \Exception
     */
    public function getObject(): string
    {
        if (null === ($object = $this->findObject())) {
            throw new \Exception("Invalid Object");
        }
        return $object;
    }

    /**
     * @return string|null
     */
    public function findObject()
    {
        return $this->object;
    }

    /**
     * @param string|null $object
     * @return $this
     */
    public function setObject(string $object = null)
    {
        $this->object = $object;
        return $this;
    }
}
