<?php

namespace Bizhub\QueryFilter\Tests;

use Bizhub\QueryFilter\QueryFilterServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            QueryFilterServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {}
}