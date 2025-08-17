<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SessionControllerTest extends TestCase
{
    public function testCreateSession()
    {
        $this->get('session/create')
            ->assertStatus(200)
            ->assertSeeText('OK')
            ->assertSessionHas('userId', 'dony')
            ->assertSessionHas('isMember', 'true');
    }

    public function testGetSession()
    {
        $this->withSession([
            'userId' => 'dony',
            'isMember' => 'true'
        ])->get('/session/get')
            ->assertStatus(200)
            ->assertSessionHas('userId', 'dony')
            ->assertSessionHas('isMember', 'true')
            ->assertSeeText("User Id: dony, Is Member: true");
    }

    public function testGetSessionFailed()
    {
        $this->get('/session/get')
            ->assertSeeText("User Id: guest, Is Member: false");
    }
}
