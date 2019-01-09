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
class DynamicQueryBuilder extends RawQueryBuilder
{
    use DynamicVariablesAttributeTrait;

    /**
     * The opening variable character
     */
    const VARIABLE_OPENING = '{';

    /**
     * The closing variable character
     */
    const VARIABLE_CLOSING = '}';

    /**
     * @inheritdoc
     */
    public function build(): string
    {
        return $this->prepareSoql($this->soql);
    }

    /**
     * @param string $soql
     * @return string
     */
    private function prepareSoql(string $soql): string
    {
        if (false === (preg_match_all(
            '/' . self::VARIABLE_OPENING . '(.*?)' . self::VARIABLE_CLOSING . '/',
            $soql,
            $matches
        ))) {
            return $soql;
        }

        $replace = $this->getReplacingAttributes($matches[1]);

        return str_ireplace(array_keys($replace), array_values($replace), $soql);
    }

    /**
     * @param array $variables
     * @return array
     */
    private function getReplacingAttributes(array $variables = [])
    {
        $attributes = $this->getVariables();

        $values = [];

        foreach ($variables as $variable) {
            $values[self::VARIABLE_OPENING . $variable . self::VARIABLE_CLOSING] = ($attributes[$variable] ?? $variable);
        }

        return $values;
    }

    /**
     * @return array
     */
    public function toConfig(): array
    {
        return array_merge(
            parent::toConfig(),
            [
                'variables' => $this->getVariables()
            ]
        );
    }
}
