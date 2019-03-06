<?php

/**
 * @copyright  Copyright (c) Flipbox Digital Limited
 * @license    https://github.com/flipbox/salesforce/blob/master/LICENSE.md
 * @link       https://github.com/flipbox/salesforce
 */

namespace Flipbox\Salesforce\Criteria;

use Flipbox\Salesforce\Resources\Instance;
use Psr\Http\Message\ResponseInterface;

/**
 * @author Flipbox Factory <hello@flipboxfactory.com>
 * @since 3.3.0
 */
class InstanceCriteria extends AbstractCriteria
{
    use ConnectionTrait,
        CacheTrait;

    /**
     * @param array $criteria
     * @param array $config
     * @return ResponseInterface
     */
    public function describe(array $criteria = [], array $config = []): ResponseInterface
    {
        $this->populate($criteria);

        return Instance::describe(
            $this->getConnection(),
            $this->getCache(),
            $this->getLogger(),
            $config
        );
    }

    /**
     * @param array $criteria
     * @param array $config
     * @return ResponseInterface
     */
    public function limits(array $criteria = [], array $config = []): ResponseInterface
    {
        $this->populate($criteria);

        return Instance::limits(
            $this->getConnection(),
            $this->getCache(),
            $this->getLogger(),
            $config
        );
    }

    /**
     * @param array $criteria
     * @param array $config
     * @return ResponseInterface
     */
    public function resources(array $criteria = [], array $config = []): ResponseInterface
    {
        $this->populate($criteria);

        return Instance::resources(
            $this->getConnection(),
            $this->getCache(),
            $this->getLogger(),
            $config
        );
    }
}
