<?php

/**
 * @copyright  Copyright (c) Flipbox Digital Limited
 * @license    https://github.com/flipbox/salesforce/blob/master/LICENSE.md
 * @link       https://github.com/flipbox/salesforce
 */

namespace Flipbox\Salesforce\Query;

/**
 * @author Flipbox Factory <hello@flipboxfactory.com>
 * @since 3.1.0
 */
interface DynamicQueryBuilderInterface extends QueryBuilderInterface
{
    /**
     * @return array
     */
    public function getVariables(): array;

    /**
     * @param array $variables
     * @return $this
     */
    public function setVariables(array $variables = []);
}
