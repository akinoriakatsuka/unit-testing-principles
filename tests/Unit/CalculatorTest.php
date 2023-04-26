<?php

namespace Tests\Feature;

use function PHPUnit\Framework\assertEquals;
use Tests\TestCase;
use App\Models\Caluculator;

class CalculatorTest extends TestCase
{
    private $_sut;

    public function setUp() :void  {
        $this->_sut = new Caluculator();
    }

    public function test_足し算(): void
    {
        $first = 10.0;
        $second = 20.0;
        // $sut = new Caluculator();

        $result = $this->_sut->sum($first, $second);
        assertEquals(30.0,$result);
    }
}
