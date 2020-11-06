<?php
namespace App\Http\Helpers;

use Illuminate\Support\Str;

class UsersHelper
{
    public static function getActualPhone(string $phone = null)
    {
        if($phone === null) {
            return null;
        }

        $phoneFormat = Str::of($phone)->replaceMatches('/\D/u', '');

        if (iconv_strlen($phoneFormat) > 10) {
            return substr($phoneFormat, 1);
        }
        return $phoneFormat;
    }

}
