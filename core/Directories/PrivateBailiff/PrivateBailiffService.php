<?php
namespace Core\Directories\PrivateBailiff;

class PrivateBailiffService
{
    public function addFirstNumber(string $phone)
    {
        if ($phone === null) {
            return null;
        }
        return "7{$phone}";
    }
}
