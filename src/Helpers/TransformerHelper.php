<?php

/**
 * @copyright  Copyright (c) Flipbox Digital Limited
 * @license    https://github.com/flipbox/salesforce/blob/master/LICENSE.md
 * @link       https://github.com/flipbox/salesforce
 */

namespace Flipbox\Salesforce\Helpers;

use Flipbox\Skeleton\Helpers\ObjectHelper;
use Flipbox\Transform\Transformers\TransformerInterface;

/**
 * @author Flipbox Factory <hello@flipboxfactory.com>
 * @since 1.0.0
 */
class TransformerHelper extends \Flipbox\Transform\Helpers\TransformerHelper
{
    /**
     * @param array|TransformerInterface|callable|null $transformer
     * @return TransformerInterface|callable|null
     * @throws \Flipbox\Skeleton\Exceptions\InvalidConfigurationException
     */
    public static function resolve($transformer = null)
    {
        if (empty($transformer)) {
            return null;
        }

        if (is_string($transformer) || is_array($transformer)) {
            return static::resolve(ObjectHelper::create($transformer));
        }

        return parent::resolve($transformer);
    }
}
