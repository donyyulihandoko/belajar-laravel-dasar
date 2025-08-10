<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\TestView;
use Tests\TestCase;

class RoutingTest extends TestCase
{
    public function testGet()
    {
        $this->get('/pzn')
            ->assertStatus(200)
            ->assertSeeText('Hello Programmer Zaman Now');
    }

    public function testRedirect()
    {
        $this->get('/youtube')
            ->assertRedirect('/pzn');
    }

    public function testFallback()
    {
        $this->get('/notfound')
            ->assertSeeText("404 by Programmer Zaman Now");
    }

    public function testView()
    {
        $this->get('/hello')
            ->assertSeeText('Hello Dony');

        $this->get('/hello-again')
            ->assertSeeText('Hello Dony');
    }

    public function testNested()
    {
        $this->get('/hello-world')
            ->assertSeeText('World Dony');
    }

    public function testRouteParameter()
    {
        $this->get('/products/1')
            ->assertSeeText('Product 1');

        $this->get('/products/2')
            ->assertSeeText('Product 2');

        $this->get('/products/1/items/XXX')
            ->assertSeeText('Product 1, Item XXX');

        $this->get('/products/1/items/XXX')
            ->assertSeeText('Product 1, Item XXX');
    }

    public function testRouteParameterRegex()
    {
        $this->get('/categories/1')
            ->assertSeeText('Category 1');

        $this->get('/categories/eko')
            ->assertSeeText("404 by Programmer Zaman Now");
    }

    public function testRouteParameterOptional()
    {
        $this->get('/users/dony')
            ->assertSeeText('User dony');

        $this->get("/users/")
            ->assertSeeText('User 404');
    }

    public function testRouteConflict()
    {
        $this->get('/conflict/dika')
            ->assertSeeText('Conflict dika');

        $this->get('/conflict/dony')
            ->assertSeeText('Conflict dony yuli handoko');
    }
}
