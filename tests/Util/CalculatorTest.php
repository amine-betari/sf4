<?php
/**
 * Created by PhpStorm.
 * User: aminebetari
 * Date: 14/12/19
 * Time: 16:58
 */

namespace App\Tests\Util;

use App\Util\Calculator;
use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{
    public function testAdd()
    {
        $calculator = new Calculator();
        $result = $calculator->add(30, 12);

        // assert that your calculator added the numbers correctly!
        $this->assertEquals(42, $result);
    }


    public function testSome()
    {
        $calculator = new Calculator();
        $result = $calculator->some(30, 12);

        // assert that your calculator added the numbers correctly!
        $this->assertEquals(32, $result);
    }
}