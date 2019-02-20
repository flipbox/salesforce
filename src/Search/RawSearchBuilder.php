<?php

/**
 * @copyright  Copyright (c) Flipbox Digital Limited
 * @license    https://github.com/flipbox/salesforce/blob/master/LICENSE.md
 * @link       https://github.com/flipbox/salesforce
 */

namespace Flipbox\Salesforce\Search;

/**
 * @author Flipbox Factory <hello@flipboxfactory.com>
 * @since 3.0.0
 */
class RawSearchBuilder extends AbstractSearchBuilder
{
    /**
     * The soql query
     *
     * @var string
     */
    public $search;

    /**
     * @inheritdoc
     */
    public function build(): string
    {
        return (string)$this->search;
    }
}
