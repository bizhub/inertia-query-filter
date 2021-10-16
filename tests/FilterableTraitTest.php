<?php

namespace Bizhub\QueryFilter\Tests;

use Bizhub\QueryFilter\Tests\Model\TestModel;

class FilterableTraitTest extends TestCase
{
    /** @test */
    public function it_filters()
    {
        TestModel::createWithName('Foo');
        TestModel::createWithName('Bar');

        request()->merge([
            'name' => 'Foo'
        ]);

        $results = TestModel::filter()->get();

        $this->assertCount(1, $results);
        $this->assertEquals('Foo', $results[0]->name);
    }
}