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
trait DynamicVariablesAttributeTrait
{
    /**
     * @var array
     */
    private $variables = [];

    /**
     * @return array
     */
    public function getVariables(): array
    {
        return $this->variables;
    }

    /**
     * @param array $variables
     * @return $this
     */
    public function setVariables(array $variables = [])
    {
        foreach ($variables as $key => $value) {
            if (!is_string($key)) {
                $key = $value['key'] ?? null;
                $value = $value['value'] ?? null;
            }

            $this->variables[$key] = $value;
        }

        return $this;
    }
}
