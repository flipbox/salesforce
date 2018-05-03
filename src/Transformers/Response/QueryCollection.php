<?php

/**
 * @copyright  Copyright (c) Flipbox Digital Limited
 * @license    https://github.com/flipbox/salesforce/blob/master/LICENSE.md
 * @link       https://github.com/flipbox/salesforce
 */

namespace Flipbox\Salesforce\Transformers\Response;

use Flipbox\Salesforce\Collections\Collection;
use Flipbox\Salesforce\Helpers\TransformerHelper;
use Flipbox\Skeleton\Helpers\ObjectHelper;
use Flipbox\Transform\Factory;
use Flipbox\Transform\Transformers\AbstractTransformer;
use Flipbox\Transform\Transformers\Traits\ArrayToObject;
use Flipbox\Transform\Transformers\TransformerInterface;

/**
 * @author Flipbox Factory <hello@flipboxfactory.com>
 * @since 1.0.0
 */
class QueryCollection extends AbstractTransformer
{
    use ArrayToObject;

    /**
     * @var callable|TransformerInterface|null
     */
    public $transformer;

    /**
     * @inheritdoc
     */
    public function transform(array $data): Collection
    {
        $collection = new Collection();

        if (null === ($transformer = TransformerHelper::resolve($this->transformer))) {
            return $collection;
        }

        $data = Factory::item(
            $transformer,
            $data
        );

        ObjectHelper::configure(
            $collection,
            $data
        );

        return $collection;
    }
}
