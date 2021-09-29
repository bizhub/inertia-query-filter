<?php

namespace Bizhub\QueryFilter;

use Illuminate\Database\Eloquent\Builder;
use Inertia\Inertia;

abstract class QueryFilter
{
    /**
     * Eloquent builder
     *
     * @var \Illuminate\Database\Eloquent\Builder
     */
    protected $builder;

    /**
     * Apply filter methods
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  array  $defaults
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply(Builder $builder, $defaults = []): Builder
    {
        $this->builder = $builder;

        request()->merge(
            array_filter($defaults, function($name){
                return ! request()->has($name);
            }, ARRAY_FILTER_USE_KEY)
        );

        $names = [];
        foreach (request()->all() as $name => $value) {
            if ( ! method_exists($this, $name)) {
                continue;
            }

            $this->$name($value);
            $names[] = $name;
        }

        Inertia::share('filters', request()->only($names));

        return $this->builder;
    }
}
