<?php

namespace App\Calculator;

use App\Contract\CalculatorContract;

class CategorySlugCalculator implements CalculatorContract
{
    public function calculate($input)
    {
        return trim(
            strtolower(
                preg_replace(
                    "/\s/",
                    "-",
                    normalizer_normalize($input)
                )
            ),
            "-"
        );
    }
}