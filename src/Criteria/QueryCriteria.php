<?php

/**
 * @copyright  Copyright (c) Flipbox Digital Limited
 * @license    https://github.com/flipbox/salesforce/blob/master/LICENSE.md
 * @link       https://github.com/flipbox/salesforce
 */

namespace Flipbox\Salesforce\Criteria;

use Flipbox\Salesforce\Query\QueryBuilderAttributeTrait;
use Flipbox\Salesforce\Resources\Query;
use Psr\Http\Message\ResponseInterface;

/**
 * @author Flipbox Factory <hello@flipboxfactory.com>
 * @since 3.3.0
 */
class QueryCriteria extends AbstractCriteria
{
    use ConnectionTrait,
        CacheTrait,
        QueryBuilderAttributeTrait;

    /**
     * @param array $criteria
     * @param array $config
     * @return ResponseInterface
     */
    public function fetch(array $criteria = [], array $config = []): ResponseInterface
    {
        $this->populate($criteria);

        return Query::query(
            $this->getQuery()->build(),
            $this->getConnection(),
            $this->getCache(),
            $this->getLogger(),
            $config
        );
    }
}
