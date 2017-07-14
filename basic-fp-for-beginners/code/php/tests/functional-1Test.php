<?php

require_once __DIR__ . '/../solution/functional-1.php';

use PHPUnit\Framework\TestCase;

final class Functional1Test extends TestCase
{
    public function testReturns1()
    {
        $this->assertEquals(1, findK1(89, 1));
    }

    public function testReturns2()
    {
        $this->assertEquals(2, findK1(695, 2));
    }

    public function testReturns51()
    {
        $this->assertEquals(51, findK1(46288, 3));
    }

    public function testReturnsMinus1()
    {
        $this->assertEquals(-1, findK1(92, 1));
    }
}

