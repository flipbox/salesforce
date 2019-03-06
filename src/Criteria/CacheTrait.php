<?php

/**
 * @copyright  Copyright (c) Flipbox Digital Limited
 * @license    https://github.com/flipbox/salesforce/blob/master/LICENSE.md
 * @link       https://github.com/flipbox/salesforce
 */

namespace Flipbox\Salesforce\Criteria;

use Flipbox\Salesforce\Salesforce;
use Psr\SimpleCache\CacheInterface;

/**
 * @author Flipbox Factory <hello@flipboxfactory.com>
 * @since 3.3.0
 */
trait CacheTrait
{
    /**
     * @var CacheInterface|null
     */
    protected $cache;

    /**
     * @param $value
     * @return $this
     */
    public function cache($value)
    {
        return $this->setCache($value);
    }

    /**
     * @param $value
     * @return $this
     */
    public function setCache($value)
    {
        $this->cache = $value;
        return $this;
    }

    /**
     * @return CacheInterface
     */
    public function getCache(): CacheInterface
    {
        return $this->cache = $this->resolveCache($this->cache);
    }

    /**
     * @param $cache
     * @return CacheInterface
     */
    protected function resolveCache($cache): CacheInterface
    {
        if ($cache instanceof CacheInterface) {
            return $cache;
        }

        return Salesforce::getCache();
    }
}
