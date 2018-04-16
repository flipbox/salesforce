<?php

/**
 * @copyright  Copyright (c) Flipbox Digital Limited
 * @license    https://github.com/flipbox/salesforce/blob/master/LICENSE.md
 * @link       https://github.com/flipbox/salesforce
 */

namespace Flipbox\Salesforce\Collections;

use Flipbox\Salesforce\Helpers\TransformerHelper;
use Flipbox\Skeleton\Collections\Collection;
use Flipbox\Skeleton\Error\ErrorInterface;
use Flipbox\Skeleton\Error\ErrorTrait;
use Flipbox\Skeleton\Exceptions\InvalidConfigurationException;
use Flipbox\Transform\Factory;
use Flipbox\Transform\Transformers\TransformerInterface;

/**
 * @author Flipbox Factory <hello@flipboxfactory.com>
 * @since 1.0.0
 */
class QueryCollection extends Collection implements ErrorInterface
{
    use ErrorTrait;

    /**
     * @var array|callable|TransformerInterface|null
     */
    public $transformer;

    /**
     * @param array $records
     * @throws InvalidConfigurationException
     */
    public function setRecords(array $records = [])
    {
        if ($transformer = $this->resolveTransformer()) {
            /** @var array $records */
            $records = Factory::collection(
                $transformer,
                $records
            );
        }

        $this->setItems($records);
    }

    /**
     * @return callable|TransformerInterface|null
     * @throws InvalidConfigurationException
     */
    public function resolveTransformer()
    {
        $this->transformer = TransformerHelper::resolve($this->transformer);
        return $this->transformer;
    }
}
