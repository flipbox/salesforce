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
class Item extends AbstractTransformer
{
    /**
     * @param mixed $payload
     * @param null $source
     * @return array|mixed|null
     */
    public function __invoke($payload, $source = null)
    {
        if (null !== ($transformer = $this->resolveTransformer())) {
            return Factory::Item(
                $transformer,
                $payload,
                [],
                ['source' => $source]
            );
        }

        return $payload;
    }
}
