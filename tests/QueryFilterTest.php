<?php

namespace Bizhub\QueryFilter\Tests;

use Illuminate\Database\Eloquent\Builder;
use Mockery\MockInterface;

class QueryFilterTest extends TestCase
{
    /** @test */
    public function it_calls_correct_filter_method()
    {
        request()->merge([
            'name' => 'Lex'
        ]);

        $this->partialMock(DummyQueryFilter::class, function(MockInterface $mock){
            $mock
                ->shouldReceive('name')
                ->withArgs(['Lex'])
                ->once();
        });

        app(DummyQueryFilter::class)->apply($this->eloquentBuilderMock());
    }

    /** @test */
    public function it_can_use_default_filters()
    {
        $this->partialMock(DummyQueryFilter::class, function(MockInterface $mock){
            $mock
                ->shouldReceive('name')
                ->withArgs(['Lex'])
                ->once();
        });

        app(DummyQueryFilter::class)->apply($this->eloquentBuilderMock(), [
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
        return $this->mock(Builder::class);
    }
}