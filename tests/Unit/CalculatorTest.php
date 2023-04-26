<?php

namespace Tests\Feature;

use function PHPUnit\Framework\assertEquals;
use Tests\TestCase;
use App\Models\Caluculator;

class CalculatorTest extends TestCase
{
    public function test_足し算(): void
    {
        $first = 10.0;
        $second = 20.0;
        $sut = new Caluculator();

        $result = $sut->sum($first, $second);
        assertEquals(30.0,$result);
    }
}
