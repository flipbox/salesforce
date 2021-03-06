<?php

/**
 * @copyright  Copyright (c) Flipbox Digital Limited
 * @license    https://github.com/flipbox/salesforce/blob/master/LICENSE.md
 * @link       https://github.com/flipbox/salesforce
 */

namespace Flipbox\Salesforce\Query;

/**
 * @author Flipbox Factory <hello@flipboxfactory.com>
 * @since 3.0.0
 */
class RawQueryBuilder extends AbstractQueryBuilder
{
    /**
     * The soql query
     *
     * @var string
     */
    public $soql;

    /**
     * @inheritdoc
     */
    public function build(): string
    {
        return (string)$this->soql;
    }

    /**
     * @return array
     */
    public function toConfig(): array
    {
        return array_merge(
            parent::toConfig(),
            [
                'soql' => $this->soql
            ]
        );
    }
}
