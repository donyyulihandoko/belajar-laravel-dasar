<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class FileControllerTest extends TestCase
{
    public function testUploadFile()
    {
        $image = UploadedFile::fake()->image('dony2.png');

        $this->post('/file/upload', [
            'image' => $image
        ])->assertSeeText('OK dony2.png');
    }
}
