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
trait PayloadAttributeTrait
{
    /**
     * @var array|null
     */
    protected $payload;

    /**
     * @return array
     */
    public function getPayload(): array
    {
        return array_filter((array)$this->payload);
    }

    /**
     * @param $payload
     * @return $this
     */
    public function setPayload($payload)
    {
        $this->payload = $payload;
        return $this;
    }
}
