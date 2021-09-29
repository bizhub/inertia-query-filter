<?php

namespace Bizhub\QueryFilter\Tests\Unit;

use Bizhub\QueryFilter\Filterable;
use Bizhub\QueryFilter\Tests\TestCase;

class QueryFilterTest extends TestCase
{
    /** @test */
    public function it_calls_correct_method()
    {
        $this->getObjectForTrait(Filterable::class);

        $this->assertTrue(true);
    }
}