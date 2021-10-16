<?php

namespace Bizhub\QueryFilter\Tests;

use Illuminate\Database\Eloquent\Builder;
use Mockery\MockInterface;

class QueryFilterTest extends TestCase
{
    /** @test */
    public function it_calls_correct_query_method()
    {
        request()->merge([
            'name' => 'Lex'
        ]);

        $queryFilter = new DummyQueryFilter;
        $queryFilter->apply($this->eloquentBuilderMock());
    }

    /** @test */
    public function it_can_use_default_filters()
    {
        $queryFilter = new DummyQueryFilter;
        $queryFilter->apply($this->eloquentBuilderMock(), [
            'name' => 'Lex'
        ]);
    }
    
    /**
     * Mock eloquent builder
     *
     * @return Builder
     */
    protected function eloquentBuilderMock()
    {
        return $this->mock(Builder::class, function(MockInterface $mock){
            $mock
                ->shouldReceive('where')
                ->withArgs(['name', 'Lex'])
                ->once();
        });
    }
}