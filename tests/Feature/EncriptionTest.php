<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Crypt;
use Tests\TestCase;

class EncriptionTest extends TestCase
{
    public function testEncription()
    {
        $encrypt = Crypt::encrypt('dony yuli handoko');
        var_dump($encrypt);

        $decrypt = Crypt::decrypt($encrypt);
        $this->assertEquals('dony yuli handoko', $decrypt);
    }
}
