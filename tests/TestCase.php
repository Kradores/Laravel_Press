<?php 

namespace Press\Tests;

use Orchestra\Testbench\TestCase as TestbenchTestCase;
use Press\PressBaseServiceProvider;

class TestCase extends TestbenchTestCase
{

    protected function setUp(): void
    {
        parent::setUp();

        $this->withFactories(__DIR__ . '/../database/factories');
    }

    /**
     * Get package providers.
     *
     * @param  \Illuminate\Foundation\Application  $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            PressBaseServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'testdb');
        $app['config']->set('database.connections.testdb', [
            'driver' => 'sqlite',
            'database' => ':memory:'
        ]);
    }
}