<?php

/**
 * @copyright  Copyright (c) Flipbox Digital Limited
 * @license    https://github.com/flipbox/salesforce/blob/master/LICENSE.md
 * @link       https://github.com/flipbox/salesforce
 */

namespace Flipbox\Salesforce\Pipeline\Stages\Transformers;

use Flipbox\Salesforce\Helpers\TransformerHelper;
use Flipbox\Skeleton\Logger\AutoLoggerTrait;
use Flipbox\Skeleton\Object\AbstractObject;
use Flipbox\Transform\Transformers\TransformerInterface;
use League\Pipeline\StageInterface;

/**
 * @author Flipbox Factory <hello@flipboxfactory.com>
 * @since 1.0.0
 */
abstract class AbstractTransformer extends AbstractObject implements StageInterface
{
    use AutoLoggerTrait;

    /**
     * @var callable|TransformerInterface|null
     */
    private $transformer;

    /**
     * @param callable|TransformerInterface|null $transformer
     * @return $this
     */
    public function setTransformer($transformer)
    {
        $this->transformer = $transformer;
        return $this;
    }

    /**s
     * @return callable|TransformerInterface|null
     */
    protected function resolveTransformer()
    {
        try {
            return TransformerHelper::resolve($this->transformer);
        } catch (\Throwable $e) {
            $this->error(
                "Unable to resolve transformer: {transformer}",
                [
                    'transformer' => json_encode($this->transformer)
                ]
            );
        }

        return null;
    }
}
