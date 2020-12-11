<?php

namespace Bizhub\QueryFilter;

trait Filterable
{
    /**
     * Filter scope
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilter($query)
    {
        $defaultClassName = '\\App\\QueryFilters\\' . class_basename($this) . 'Filter';

        return (new $defaultClassName)->apply($query);
    }
}