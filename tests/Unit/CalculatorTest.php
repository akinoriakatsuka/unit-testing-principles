<?php

namespace Tests\Feature;

use function PHPUnit\Framework\assertEquals;
use Tests\TestCase;
use App\Models\Caluculator;

class CalculatorTest extends TestCase
{

    public function add_parameters()
    {
        return [
            [0, 1, 1],
            [1, 1, 2],
            [1, 9, 10],
            [1, 10, 11],
            [10, 10, 20],
            [0, -1, -1],
            [1, -2, -1],
            [-1, 1, 0],
            [-1, -9, -10],
            [-1, -10, -11],
            [-10, -10, -20],
        ];
    }

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

    /**
     * @dataProvider add_parameters
     */
    public function testAdd($input_a, $input_b, $expected)
    {
        $result = $this->_sut->sum($input_a, $input_b);

        $this->assertEquals($expected, $result, "足し算の結果が正しくありません");
    }

}
