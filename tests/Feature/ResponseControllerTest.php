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

    public function testResponseView()
    {
        $this->post('/response/type/view')
            ->assertSeeText('Hello dony');
    }

    public function testResponseJson()
    {
        $this->post('/response/type/json')
            ->assertJson([
                'firstName' => 'Dony',
                'middleName' => 'Yuli',
                'lastName' => 'Handoko'
            ]);
    }

    public function testResponseFile()
    {
        $this->post('/response/type/file')
            ->assertHeader('Content-Type', 'image/png');
    }

    public function testResponseDonwload()
    {
        $this->get('/response/type/donwload')
            ->assertDownload('dony.png');
    }
}
