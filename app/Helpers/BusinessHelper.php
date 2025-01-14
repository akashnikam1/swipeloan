<?php

namespace App\Helpers;

use App\Models\Business;

class BusinessHelper
{
    public static function getBusinessInfo($key)
    {
        return Business::where('key', $key)->pluck('value')->first();
    }
}
