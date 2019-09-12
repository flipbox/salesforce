<?php

/**
 * @copyright  Copyright (c) Flipbox Digital Limited
 * @license    https://github.com/flipbox/salesforce/blob/master/LICENSE.md
 * @link       https://github.com/flipbox/salesforce
 */

namespace Flipbox\Salesforce\Criteria;

use Flipbox\Salesforce\Resources\Url;
use Psr\Http\Message\ResponseInterface;

/**
 * @author Flipbox Factory <hello@flipboxfactory.com>
 * @since 3.4.0
 */
class UrlCriteria extends AbstractCriteria
{
    use ConnectionTrait,
        CacheTrait;

    /**
     * @var string|null
     */
    protected $url;

    /**
     * @return string
     * @throws \Exception
     */
    public function getUrl(): string
    {
        if (null === ($url = $this->findUrl())) {
            throw new \Exception("Invalid Url");
        }
        return $url;
    }

    /**
     * @return string|null
     */
    public function findUrl()
    {
        return $this->url;
    }

    /**
     * @param string|null $url
     * @return $this
     */
    public function setUrl(string $url = null)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @param array $criteria
     * @param array $config
     * @return ResponseInterface
     * @throws \Exception
     */
    public function read(array $criteria = [], array $config = []): ResponseInterface
    {
        $this->populate($criteria);

        return Url::read(
            $this->getUrl(),
            $this->getConnection(),
            $this->getCache(),
            $this->getLogger(),
            $config
        );
    }
}
