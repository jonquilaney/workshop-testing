<?php declare(strict_types=1);

namespace IW\Tests\Workshop;

use IW\Workshop\Calculator;
use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{

    /**
     * @var Calculator $calculator
     */
    private $calculator;



    public function setUp()
    {
        $this->calculator = new Calculator();
    }



    /**
     * @dataProvider additionDataProvider
     */
    public function testAddition(float $a, float $b, float $expectedResult)
    {
        $result = $this->calculator->add($a, $b);
        $this->assertEquals($expectedResult, $result);
    }



    public function additionDataProvider()
    {
        return [
            [2, 2, 4],
            [-2, -2, -4],
            [-2, 2, 0],
            [2, -2, 0],
            [0, 0, 0],
            [3.7, 5.8, 9.5],
        ];
    }


    /**
     * @dataProvider divisionDataProvider
     */
    public function testDivision(float $a, float $b, float $expectedResult)
    {
        $result = $this->calculator->divide($a,$b);
        $this->assertEquals($expectedResult, $result);
    }



    public function divisionDataProvider()
    {
        return [
            [10, 5, 2],
            [-10, -5, 2],
            [-10, 5, -2],
            [10, -5, -2],
            [50.6, 2.5, 20.24],
        ];
    }



    /**
     * @expectedException \InvalidArgumentException
     */
    public function testDivisionByZeroShouldThrowException()
    {
        $this->calculator->divide(4, 0);
    }

}
