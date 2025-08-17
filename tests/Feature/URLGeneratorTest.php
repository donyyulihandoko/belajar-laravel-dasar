<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class URLGeneratorTest extends TestCase
{
    public function testUrlCurrent()
    {
        $this->get('url/current?name=eko')
            ->assertSeeText('url/current?name=eko');
    }

    public function testUrlNamed()
    {
        $this->get('redirect/named')
            ->assertSeeText('redirect/name/Dony');
    }

    public function testUrlAction()
    {
        $this->get('/url/action')
            ->assertSeeText('/form');
    }
}
