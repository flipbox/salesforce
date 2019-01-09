<?php

/**
 * @copyright  Copyright (c) Flipbox Digital Limited
 * @license    https://github.com/flipbox/skeleton/blob/master/LICENSE
 * @link       https://github.com/flipbox/skeleton
 */

namespace Flipbox\Salesforce\Tests\Search;

use Flipbox\Salesforce\Search\DynamicSearchBuilder;

/**
 * @author Flipbox Factory <hello@flipboxfactory.com>
 * @since 2.0.0
 */
class DynamicSearchBuilderTest extends \PHPUnit_Framework_TestCase
{

    public function buildTest()
    {
        $builder = new DynamicSearchBuilder();
        $builder->search = '{replace} me.';
        $builder->setVariables([
            'replace' => 'replaced'
        ]);

        $this->assertEquals(
            'replaced me.',
            $builder->build()
        );
    }


    public function toConfigTest()
    {
        $builder = new DynamicSearchBuilder();
        $builder->search = 'test';
        $builder->setVariables([
            'foo' => 'bar'
        ]);

        $this->assertEquals(
            [
                'class' => DynamicSearchBuilder::class,
                'search' => $builder->search,
                'variables' => [
                    'foo' => 'bar'
                ]
            ],
            $builder->toConfig()
        );

    }
}