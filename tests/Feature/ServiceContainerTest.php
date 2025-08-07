<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Data\Foo;
use App\Data\Person;
use App\Services\HelloService;
use App\Services\HelloServiceImpl;

class ServiceContainerTest extends TestCase
{
    public function testServiceContainer()
    {
        $foo = $this->app->make(Foo::class);
        $foo2 = $this->app->make(Foo::class);


        $this->assertEquals('Foo', $foo->foo());
        $this->assertEquals('Foo', $foo2->foo());
        $this->assertNotSame($foo, $foo2);
    }

    public function testBind()
    {
        $this->app->bind(Person::class, function ($app) {
            return new Person(firstName: "Dony", lastName: "Handoko");
        });

        $person = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);

        $this->assertEquals('Dony', $person->firstName);
        $this->assertEquals('Dony', $person2->firstName);
        $this->assertNotSame($person, $person2);
    }

    public function testSingleTon()
    {
        $this->app->singleton(Person::class, function ($app) {
            return new Person(firstName: "Dony", lastName: "Handoko");
        });

        $person = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);

        $this->assertEquals('Dony', $person->firstName);
        $this->assertEquals('Dony', $person2->firstName);
        $this->assertSame($person, $person2);
    }

    public function testInstance()
    {
        $person = new Person(firstName: "Dony", lastName: "Handoko");
        $this->app->instance(Person::class, $person);

        $person1 = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);

        $this->assertEquals('Dony', $person1->firstName);
        $this->assertEquals('Dony', $person2->firstName);
        $this->assertSame($person1, $person2);
    }

    // binding interface
    public function testInterface()
    {
        $this->app->singleton(HelloService::class, function ($app) {
            return new HelloServiceImpl();
        });

        $hello = $this->app->make(HelloService::class);

        $this->assertEquals('Hello Dony', $hello->sayHello('Dony'));
    }
}
