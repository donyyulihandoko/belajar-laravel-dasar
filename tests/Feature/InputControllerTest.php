<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InputControllerTest extends TestCase
{
    public function testInput()
    {
        $this->get('/request/hello?name=Eko')
            ->assertSeeText('Hello Eko');

        $this->post('/request/hello', [
            'name' => 'Eko'
        ])->assertSeeText('Hello Eko')
        ;
    }

    public function testNested()
    {
        $this->post('/input.nested', [
            'name' => [
                'first' => 'Eko',
                'last' => 'dony'
            ]
        ])->assertSeeText("Hallo Eko");
    }

    public function testAllInput()
    {
        $this->post('/input.all', [
            'name' => [
                'first' => 'dony',
                'last' => 'handoko'
            ]
        ])->assertSeeText('name')
            ->assertSeeText('first')
            ->assertSeeText('dony')
            ->assertSeeText('last')
            ->assertSeeText('handoko');
    }

    public function testInputArray()
    {
        $this->post('/input.array', [
            'product' =>
            [
                'name' => 'Macbook Pro',
                'price' => '10000000'
            ],
            [
                'name' => 'Samsung Galaksi',
                'price' => '10_000_000'
            ]
        ])->assertSeeText('name')
            ->assertSeeText('Macbook Pro')
            ->assertSeeText('name')
            ->assertSeeText('Samsung Galaksi');
    }
}
