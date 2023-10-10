<?php

class RPN
{
    private array $operators = ['+', '-', '*', '/'];

    /**
     *  Calculate the result of the given expression in Reverse Polish Notation (RPN).
     *
     * @param string $input The expression in RPN
     * @return float The result of the calculation
     * @throws Exception If there is an error in the expression or calculation
     */
    public function calculate(string $input): float {
        if (empty($input)) {
            throw new Exception("Expression is empty");
        }
        $stack = [];

        foreach (explode(' ', $input) as $token) {
            if (is_numeric($token)) {
                $stack[] = $token;
            } elseif (in_array($token, $this->operators)) {
                if (count($stack) < 2) {
                    throw new Exception("Not enough operands for operator $token");
                }
                $operand1 = array_pop($stack);
                $operand2 = array_pop($stack);
                $result = $this->applyOperator($operand1, $operand2, $token);

                $stack[] = $result;

            } else {
                throw new Exception("Incorrect token '$token'");
            }
        }
        if (count($stack) !== 1) {
            throw new Exception("Result is not a single number");
        }

        return array_pop($stack);
    }

    /**
     * Apply the specified operator to two operands.
     *
     * @param float $operand1 The first operand
     * @param float $operand2 The second operand
     * @param string $operator The operator
     * @return float The result of the operation
     * @throws Exception If there is an error during the operation
     */
    private function applyOperator(float $operand1, float $operand2, string $operator): float {
        switch ($operator) {
            case '+':
                return $operand2 + $operand1;
            case '-':
                return $operand2 - $operand1;
            case '*':
                return $operand2 * $operand1;
            case '/':
                if ($operand1 == 0) {
                    throw new DivisionByZeroError("Division by zero");
                }
                return $operand2 / $operand1;
            default:
                throw new Exception("Unknown operator '$operator'");
        }
    }
}


