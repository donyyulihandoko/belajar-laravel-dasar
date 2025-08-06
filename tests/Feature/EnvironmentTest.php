<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EnvironmentTest extends TestCase
{
    public function testEnv()
    {
        $appName = env("YOUTUBE");
        $this->assertEquals("Programmer Zaman Now", $appName);
    }

    public function testDefaultEnv()
    {
        $author = env('AUTHOR', 'Dony');
        $this->assertEquals("Dony", $author);
    }
}
