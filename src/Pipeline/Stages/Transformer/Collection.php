<?php

/**
 * @copyright  Copyright (c) Flipbox Digital Limited
 * @license    https://github.com/flipbox/salesforce/blob/master/LICENSE.md
 * @link       https://github.com/flipbox/salesforce
 */

namespace Flipbox\Salesforce\Pipeline\Stages\Transformers;

use Flipbox\Transform\Factory;

/**
 * @author Flipbox Factory <hello@flipboxfactory.com>
 * @since 1.0.0
 */
class Collection extends AbstractTransformer
{
    /**
     * @param mixed $payload
     * @return array|mixed|null
     */
    public function __invoke($payload)
    {
        if (null !== ($transformer = $this->resolveTransformer())) {
            return Factory::Collection(
                $transformer,
                $payload
            );
        }

        return $payload;
    }
}
