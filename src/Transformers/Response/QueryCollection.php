<?php

/**
 * @copyright  Copyright (c) Flipbox Digital Limited
 * @license    https://github.com/flipbox/salesforce/blob/master/LICENSE.md
 * @link       https://github.com/flipbox/salesforce
 */

namespace Flipbox\Salesforce\Transformers\Response;

use Flipbox\Salesforce\Collections\QueryCollection as Collection;
use Flipbox\Transform\Transformers\AbstractTransformer;
use Flipbox\Transform\Transformers\Traits\ArrayToObject;

/**
 * @author Flipbox Factory <hello@flipboxfactory.com>
 * @since 1.0.0
 */
class QueryCollection extends AbstractTransformer
{
    use ArrayToObject;

    /**
     * The record level transformer
     *
     * @var mixed
     */
    public $record;

    /**
     * @inheritdoc
     */
    public function transform(array $data): Collection
    {
        return new Collection(array_merge(
            ['transformer' => $this->record],
            $data
        ));
    }
}
