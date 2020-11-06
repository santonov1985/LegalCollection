<?php
namespace Core\Directories\PrivateBailiff;

class PrivateBailiffService
{
    public function addFirstNumber(string $phone)
    {
        return "7{$phone}";
    }
}
