<?php

/**
 * @copyright  Copyright (c) Flipbox Digital Limited
 * @license    https://github.com/flipbox/salesforce/blob/master/LICENSE.md
 * @link       https://github.com/flipbox/salesforce
 */

namespace Flipbox\Salesforce\Query;

use flipbox\force\Force;
use Flipbox\Skeleton\Object\AbstractObject;

/**
 * @author Flipbox Factory <hello@flipboxfactory.com>
 * @since 1.0.0
 */
abstract class AbstractQueryBuilder extends AbstractObject implements QueryBuilderInterface
{
    /**
     * @return mixed|string
     */
    public function __toString()
    {
        return $this->build();
    }

    /**
     * @return array
     */
    public function toConfig(): array
    {
        return [
            'class' => get_class($this)
        ];
    }
}
