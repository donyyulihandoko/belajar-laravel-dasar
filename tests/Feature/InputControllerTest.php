<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use tidy;

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

    public function testInputType()
    {
        $this->post('/input.type', [
            'name' => 'Dony',
            'married' => 'false',
            'birthday' => '2000-07-18'
        ])->assertSeeText('Dony')
            ->assertSeeText('false')
            ->assertSeeText('2000-07-18');
    }

    public function testInputOnly()
    {
        $this->post('/input/hello/only', [
            'name' => [
                'first' => 'Dony',
                'middle' => 'Yuli',
                'last' => 'Handoko'
            ]
        ])->assertSeeText('Dony')
            ->assertSeeText('Yuli')
            ->assertDontSeeText('Handoko');
    }

    public function testInputExcept()
    {
        $this->post('/input.except', [
            'username' => 'dony',
            'password' => 'rahasia',
            'admin' => 'true'
        ])->assertSeeText('dony')
            ->assertSeeText('rahasia')
            ->assertDontSeeText('admin');
    }

    public function testInputMerge()
    {
        $this->post('/input.merge', [
            'username' => 'dony',
            'password' => 'rahasia',
            'admin' => 'true'
        ])->assertSeeText('dony')
            ->assertSeeText('rahasia')
            ->assertSeeText('admin')
            ->assertSeeText('false');
    }
}
