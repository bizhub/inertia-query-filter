<?php

namespace Bizhub\QueryFilter;

trait Filterable
{
    /**
     * Filter scope
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  array  $defaults
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilter($query, $defaults = [])
    {
        return app($this->queryFilterName())->apply($query, $defaults);
    }

    /**
     * Get query filter class name
     *
     * @return string
     */
    protected function queryFilterName(): string
    {
        return '\\App\\QueryFilters\\' . class_basename($this) . 'Filter';
    }
}