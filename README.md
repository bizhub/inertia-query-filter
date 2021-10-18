# Inertia Query Filter

[![Latest Version on Packagist](https://img.shields.io/packagist/v/bizhub/inertia-query-filter.svg?style=flat-square)](https://packagist.org/packages/bizhub/inertia-query-filter)

## Install

``` bash
composer require bizhub/inertia-query-filter
```

# Example

## 1. Create filter in App\QueryFilters
``` php
<?php

namespace App\QueryFilters;

use Bizhub\QueryFilter\QueryFilter;

class UserFilter extends QueryFilter
{
    public function trashed()
    {
        $this->builder->withTrashed();
    }
    
    public function status($value)
    {
        $this->builder->where('status', $value);
    }
}
```

## 2. Add Filterable trait to the model
``` php
<?php

namespace App\Models;

use Illuminate\Http\Request;
use Bizhub\QueryFilter\Filterable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Filterable;
}
```

## 3. Use filter scope
``` php
<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * Get list of users
     *
     * @param Request $request
     * @return \Inertia\Response
     */
    public function index(Request $request)
    {
        return Inertia::render('Users/Index', [
            'users' => User::filter()->paginate()
        ]);
    }
}
```

## 4. Use $inertia.replace in page/component
``` javascript
import throttle from 'lodash/throttle'
import pickBy from 'lodash/pickBy'
import mapValues from 'lodash/mapValues'

export default {
    props: ['users', 'filters'],

    data() {
        return {
            filter: {
                trashed: this.filters.trashed,
                status: this.filters.status
            }
        }
    },

    watch: {
        filter: {
            handler: throttle(function() {
                this.$inertia.replace(
                    route('users', pickBy(this.filter)), {
                        only: ['users'],
                    }
                )
            }, 500),
            deep: true
        }
    },

    methods: {
        clearFilter() {
            this.filter = mapValues(this.filter, () => null)
        }
    }
}
```