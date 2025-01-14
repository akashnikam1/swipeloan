<?php

namespace App\Helpers;

use NumberToWords\NumberToWords;

class NumberHelper
{
    public static function amountInWords($amount)
    {
        $numberToWords = new NumberToWords();
        $numberTransformer = $numberToWords->getNumberTransformer('en');

        return ucfirst($numberTransformer->toWords($amount));
    }
}
