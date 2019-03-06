<?php

/**
 * @copyright  Copyright (c) Flipbox Digital Limited
 * @license    https://github.com/flipbox/salesforce/blob/master/LICENSE.md
 * @link       https://github.com/flipbox/salesforce
 */

namespace Flipbox\Salesforce\Criteria;

use Flipbox\Salesforce\Resources\Search;
use Flipbox\Salesforce\Search\SearchBuilderAttributeTrait;
use Psr\Http\Message\ResponseInterface;

/**
 * @author Flipbox Factory <hello@flipboxfactory.com>
 * @since 3.3.0
 */
class SearchCriteria extends AbstractCriteria
{
    use ConnectionTrait,
        CacheTrait,
        SearchBuilderAttributeTrait;

    /**
     * @param array $criteria
     * @param array $config
     * @return ResponseInterface
     */
    public function fetch(array $criteria = [], array $config = []): ResponseInterface
    {
        $this->populate($criteria);

        return Search::search(
            $this->getSearch()->build(),
            $this->getConnection(),
            $this->getCache(),
            $this->getLogger(),
            $config
        );
    }
}
