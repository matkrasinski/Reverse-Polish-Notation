<?php

require_once 'RPN.php';
require_once 'RPNCalculator.php';
use PHPUnit\Framework\TestCase;

class RPNCalculatorTest extends TestCase {

    private RPN $rpn;

    protected function setUp(): void
    {
        $this->rpn = new RPNCalculator();
    }

    public function testSimpleAddition() {
        $input = "2 3 +";
        $result = $this->rpn->calculate($input);
        $this->assertEquals(5, $result);
    }

    public function testSimpleSubtraction() {
        $input = "5 3 -";
        $result = $this->rpn->calculate($input);
        $this->assertEquals(2, $result);
    }

    public function testSimpleMultiplication() {
        $input = "2 3 *";
        $result = $this->rpn->calculate($input);
        $this->assertEquals(6, $result);
    }

    public function testSimpleDivision() {
        $input = "6 3 /";
        $result = $this->rpn->calculate($input);
        $this->assertEquals(2, $result);
    }

    public function testComplexExpression1() {
        $input = "5 2 4 * + 7 -";
        $result = $this->rpn->calculate($input);
        $this->assertEquals(6, $result);
    }
    public function testComplexExpression2() {
        $input = "5 1 2 + 4 * + 3 -";
        $result = $this->rpn->calculate($input);
        $this->assertEquals(14, $result);
    }

    public function testDivisionByZero() {
        $input = "3 0 /";
        $this->expectException(DivisionByZeroError::class);
        $this->rpn->calculate($input);
    }

    public function testInvalidToken() {
        $input = "2 x +";
        $this->expectException(Exception::class);
        $this->rpn->calculate($input);
    }

    public function testEmptyExpression() {
        $this->expectException(Exception::class);
        $this->rpn->calculate('');
    }
}

