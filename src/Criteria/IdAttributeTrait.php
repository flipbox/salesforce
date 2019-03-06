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
trait IdAttributeTrait
{
    /**
     * @var string|null
     */
    protected $id;

    /**
     * @return string
     * @throws \Exception
     */
    public function getId(): string
    {
        if (null === ($id = $this->findId())) {
            throw new \Exception("Invalid Object Id");
        }
        return $id;
    }

    /**
     * @return string|null
     */
    public function findId()
    {
        return $this->id;
    }

    /**
     * @param string|null $id
     * @return $this
     */
    public function setId(string $id = null)
    {
        $this->id = $id;
        return $this;
    }
}
