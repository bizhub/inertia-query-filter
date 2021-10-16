<?php

namespace Bizhub\QueryFilter\Tests;

use Bizhub\QueryFilter\QueryFilter;

class DummyQueryFilter extends QueryFilter
{
    public function name($value)
    {
        $this->builder->where('name', $value);
    }
}