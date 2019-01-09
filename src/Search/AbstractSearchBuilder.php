<?php

/**
 * @copyright  Copyright (c) Flipbox Digital Limited
 * @license    https://github.com/flipbox/salesforce/blob/master/LICENSE.md
 * @link       https://github.com/flipbox/salesforce
 */

namespace Flipbox\Salesforce\Search;

use InvalidArgumentException;

/**
 * @author Flipbox Factory <hello@flipboxfactory.com>
 * @since 3.0.0
 */
abstract class AbstractSearchBuilder implements SearchBuilderInterface
{
    /**
     * @return mixed|string
     */
    public function __toString()
    {
        return $this->build();
    }

    /**
     * @return array
     */
    public function toConfig(): array
    {
        return [
            'class' => get_class($this)
        ];
    }

    /**
     * @param array $properties
     */
    public function __construct(array $properties = [])
    {
        $this->populate($properties);
    }

    /**
     * @param array $properties
     * @return static
     */
    public function populate(array $properties = [])
    {
        if (!empty($properties)) {
            foreach ($properties as $name => $value) {
                if ($this->canSetProperty($name)) {
                    $this->{$name} = $value;
                }
            }
        }

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function hasProperty($name, $checkVars = true): bool
    {
        return $this->canGetProperty($name, $checkVars) || $this->canSetProperty($name, false);
    }

    /**
     * @inheritdoc
     */
    public function canGetProperty($name, $checkVars = true): bool
    {
        return method_exists($this, 'get' . $name) || $checkVars && property_exists($this, $name);
    }

    /**
     * @inheritdoc
     */
    public function canSetProperty($name, $checkVars = true): bool
    {
        return method_exists($this, 'set' . $name) || $checkVars && property_exists($this, $name);
    }

    /**
     * @inheritdoc
     */
    public function hasMethod($name): bool
    {
        return method_exists($this, $name);
    }

    /**
     * @param $name
     * @return mixed
     * @throws InvalidArgumentException
     */
    public function __get($name)
    {
        $getter = 'get' . $name;
        if (method_exists($this, $getter)) {
            return $this->$getter();
        } elseif (method_exists($this, 'set' . $name)) {
            throw new InvalidArgumentException('Getting write-only property: ' . get_class($this) . '::' . $name);
        } else {
            throw new InvalidArgumentException('Getting unknown property: ' . get_class($this) . '::' . $name);
        }
    }

    /**
     * @param $name
     * @param $value
     * @throws InvalidArgumentException
     */
    public function __set($name, $value)
    {
        $setter = 'set' . $name;
        if (method_exists($this, $setter)) {
            $this->$setter($value);
        } elseif (method_exists($this, 'get' . $name)) {
            throw new InvalidArgumentException('Setting read-only property: ' . get_class($this) . '::' . $name);
        } else {
            throw new InvalidArgumentException('Setting unknown property: ' . get_class($this) . '::' . $name);
        }
    }

    /**
     * @param $name
     * @return bool
     */
    public function __isset($name)
    {
        $getter = 'get' . $name;
        if (method_exists($this, $getter)) {
            return $this->$getter() !== null;
        } else {
            return false;
        }
    }

    /**
     * @param $name
     * @throws InvalidArgumentException
     */
    public function __unset($name)
    {
        $setter = 'set' . $name;
        if (method_exists($this, $setter)) {
            $this->$setter(null);
        } elseif (method_exists($this, 'get' . $name)) {
            throw new InvalidArgumentException('Unsetting read-only property: ' . get_class($this) . '::' . $name);
        }
    }

    /**
     * @param $name
     * @param $params
     * @throws InvalidArgumentException
     */
    public function __call($name, $params)
    {
        throw new InvalidArgumentException('Calling unknown method: ' . get_class($this) . "::$name()");
    }
}
