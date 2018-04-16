<?php

/**
 * @copyright  Copyright (c) Flipbox Digital Limited
 * @license    https://github.com/flipbox/salesforce/blob/master/LICENSE.md
 * @link       https://github.com/flipbox/salesforce
 */

namespace Flipbox\Salesforce\Transformers\Collections;

/**
 * @author Flipbox Factory <hello@flipboxfactory.com>
 * @since 1.0.0
 */
class TransformerCollection implements TransformerCollectionInterface
{
    use TransformerCollectionTrait;

    /**
     * TransformerCollection constructor.
     * @param array $transformers
     */
    public function __construct($transformers = [])
    {
        if (!empty($transformers)) {
            foreach ($transformers as $key => $transformer) {
                $this->addTransformer($key, $transformer);
            }
        }
    }
}
