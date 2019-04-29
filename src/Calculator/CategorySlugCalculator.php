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
                    "/\s|[^a-zA-Z0-9]/",
                    "_",
                    transliterator_transliterate('Any-Latin; Latin-ASCII; [^\u001F-\u007f] remove', $input)
                )
            ),
            "_"
        );
    }
}