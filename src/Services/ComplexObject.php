<?php
/**
 * Created by PhpStorm.
 * User: aminebetari
 * Date: 04/11/19
 * Time: 16:45
 */

namespace App\Services;


class ComplexObject
{
    private $foo;
    private $bar;
    private $baz;
    private $other;

    public function __construct(
        Foo $foo,
        Bar $bar,
        Baz $baz,
        Other $other
    )
    {
        $this->foo = $foo;
        $this->bar = $bar;
        $this->baz = $baz;
        $this->other = $other;
    }

    public function doSomething() {
        // ...
    }
}