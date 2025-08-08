<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Data\Bar;
use App\Data\Foo;
use App\Services\HelloService;
use App\Services\HelloServiceImpl;

class FooBarServiceProviderTest extends TestCase
{
    public function testServiceProvider()
    {
        $foo1 = $this->app->make(Foo::class);
        $foo2 = $this->app->make(Foo::class);

        $bar1 = $this->app->make(Bar::class);
        $bar2 = $this->app->make(Bar::class);

        $this->assertSame($foo1, $foo2);
        $this->assertSame($bar1, $bar2);

        $this->assertEquals($foo1, $bar1->foo);
        $this->assertEquals($foo2, $bar2->foo);
    }

    public function testServiceProviderProperty()
    {
        $hello1 = $this->app->make(HelloService::class);
        $hello2 = $this->app->make(HelloService::class);

        $this->assertSame($hello1, $hello2);
    }

    public function testEmpty()
    {
        $this->assertTrue(true);
    }
}
