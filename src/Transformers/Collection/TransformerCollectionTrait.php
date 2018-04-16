<?php

/**
 * @copyright  Copyright (c) Flipbox Digital Limited
 * @license    https://github.com/flipbox/salesforce/blob/master/LICENSE.md
 * @link       https://github.com/flipbox/salesforce
 */

namespace Flipbox\Salesforce\Transformers\Collections;

use flipbox\ember\helpers\ArrayHelper;
use Flipbox\Salesforce\Helpers\TransformerHelper;
use Flipbox\Transform\Transformers\TransformerInterface;

/**
 * @author Flipbox Factory <hello@flipboxfactory.com>
 * @since 1.0.0
 */
trait TransformerCollectionTrait
{
    /**
     * @var array
     */
    protected $transformers = [];

    /**
     * @var array
     */
    public $keys = [
        'response',
        'error'
    ];

    /*******************************************
     * TRANSFORMER
     *******************************************/

    /**
     * Checks if any of the keys have explicitly been defined.
     *
     * @return bool
     */
    protected function hasExplicitTransformersDefined(): bool
    {
        if (!is_array($this->transformers)) {
            return false;
        }

        foreach ($this->keys as $key) {
            if (array_key_exists($key, $this->transformers)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param $transformers
     * @return $this
     */
    public function setTransformers($transformers)
    {
        $this->transformers = $this->ensureArray($transformers);
        return $this;
    }

    /**
     * @param string $key
     * @param $transformer
     * @return $this
     */
    public function addTransformer(string $key, $transformer)
    {
        $this->transformers[$key] = $transformer;
        return $this;
    }

    /**
     * @param $transformers
     * @return array
     */
    protected function ensureArray($transformers): array
    {
        if (!is_array($transformers)) {
            $transformers = empty($transformers) ? [] : ['default' => $transformers];
        }

        return $transformers;
    }


    /**
     * @param string $key
     * @return TransformerInterface|mixed|null|string
     */
    protected function lookupTransformer(string $key)
    {
        $transformer = $this->transformers;

        if ($this->hasExplicitTransformersDefined()) {
            $transformer = ArrayHelper::remove($transformer, $key);
        }

        return $transformer;
    }

    /**
     * @inheritdoc
     */
    public function getTransformer(string $key)
    {
        return TransformerHelper::resolve(
            $this->lookupTransformer($key)
        );
    }
}
