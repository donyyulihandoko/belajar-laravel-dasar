<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FileStorageTest extends TestCase
{
    public function testFileStorage()
    {
        $filesystem = Storage::disk('local');
        $filesystem->put('file.txt', 'Dony Yuli Handoko');

        $content = $filesystem->get('file.txt');

        $this->assertEquals('Dony Yuli Handoko', $content);
    }

    public function testFileStoragePublic()
    {
        $filesystem = Storage::disk('public');
        $filesystem->put('file.txt', 'Dony Yuli Handoko');

        $content = $filesystem->get('file.txt');

        $this->assertEquals('Dony Yuli Handoko', $content);
    }
}
