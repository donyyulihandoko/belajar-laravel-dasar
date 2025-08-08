<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class FacadeTest extends TestCase
{
    public function testConfig()
    {
        $name1 = config('contoh.author.firstName');
        $name2 = Config::get('contoh.author.firstName');

        $this->assertEquals($name1, $name2);
    }

    public function testConfigDependency()
    {
        $config = $this->app->make('config');
        $name3 = $config->get('contoh.author.name');

        $name1 = config('contoh.author.firstName');
        $name2 = Config::get('contoh.author.firstName');

        $this->assertEquals($name1, $name2);
        $this->assertEquals($name1, $name3);
    }

    public function testFacadeMock()
    {
        Config::shouldReceive('get')
            ->with('contoh.author.first')
            ->andReturn('Dony Ganteng');

        $firstName = Config::get('contoh.author.first');

        $this->assertEquals('Dony Ganteng', $firstName);
    }
}
