<?php

namespace App\Http\Helpers;

use Illuminate\Support\Str;

class TablesHelper
{
    public function numericClear($number)
    {
        if($number === null) {
            return null;
        }

        return Str::of($number)->replaceMatches('/[^A-Za-z0-9]++/', '');

    }
}
