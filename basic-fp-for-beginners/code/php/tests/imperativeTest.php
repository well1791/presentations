<?php

require_once __DIR__ . '/../solution/imperative.php';

use PHPUnit\Framework\TestCase;

final class ImperativeTest extends TestCase
{
    public function testReturns1()
    {
        $this->assertEquals(1, findK(89, 1));
    }

    public function testReturns2()
    {
        $this->assertEquals(2, findK(695, 2));
    }

    public function testReturns51()
    {
        $this->assertEquals(51, findK(46288, 3));
    }

    public function testReturnsMinus1()
    {
        $this->assertEquals(-1, findK(92, 1));
    }
}
