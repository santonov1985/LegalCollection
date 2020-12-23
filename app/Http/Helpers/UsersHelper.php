<?php
namespace App\Http\Helpers;

use Illuminate\Support\Str;

class UsersHelper
{
    public static function getActualPhone(string $phone = null)
    {
        if($phone === null || empty($phone)) {
            return null;
        }

        $phoneFormat = Str::of($phone)->replaceMatches('/\D/u', '');

        if (iconv_strlen($phoneFormat) > 10) {
            $phoneFormat =  substr($phoneFormat, 1, 10);
        }

        return "7{$phoneFormat}";
    }

}
