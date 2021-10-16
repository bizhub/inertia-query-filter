<?php

namespace Bizhub\QueryFilter\Tests\Model;

use Bizhub\QueryFilter\Filterable;
use Bizhub\QueryFilter\Tests\DummyQueryFilter;
use Illuminate\Database\Eloquent\Model;

class TestModel extends Model
{
    use Filterable;

    protected $fillable = ['name'];

    public static function createWithName($name)
    {
        return static::create([
            'name' => $name,
        ]);
    }

    protected function queryFilterName(): string
    {
        return DummyQueryFilter::class;
    }
}