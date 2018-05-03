<?php

/**
 * @copyright  Copyright (c) Flipbox Digital Limited
 * @license    https://github.com/flipbox/salesforce/blob/master/LICENSE.md
 * @link       https://github.com/flipbox/salesforce
 */

namespace Flipbox\Salesforce\Transformers\Collections;

use Flipbox\Transform\Transformers\TransformerInterface;

/**
 * @author Flipbox Factory <hello@flipboxfactory.com>
 * @since 1.0.0
 */
interface TransformerCollectionInterface
{
    /**
     * The stage key for 'successful' HTTP Response
     */
    const SUCCESS_KEY = 'response';

    /**
     * The stage key for 'error' HTTP Response
     */
    const ERROR_KEY = 'error';

    /**
     * @param string $key
     * @return TransformerInterface|callable|null
     */
    public function getTransformer(string $key);
}
