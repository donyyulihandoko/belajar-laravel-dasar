<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ResponseControllerTest extends TestCase
{
    public function testResponse()
    {
        $this->post('/response/hello')->assertStatus(200)
            ->assertSeeText('Hello Response');
    }

    public function testResponseHeader()
    {
        $this->post('/response/header')->assertStatus(200)
            ->assertSeeText('Dony')->assertSeeText('Yuli')
            ->assertSeeText('Handoko')
            ->assertHeader('Content-Type', 'application/json')
            ->assertHeader('Author', 'Dony Yuli Handoko')
            ->assertHeader('App', 'Laravel');
    }
}
