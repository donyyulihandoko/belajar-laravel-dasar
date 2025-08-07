<?php

namespace App\Services;

class HelloServiceImpl implements HelloService
{
    public function sayHello($name): string
    {
        return "Hello $name";
    }
}
