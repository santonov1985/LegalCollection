<?php
namespace Core\Directories\Notaries;

class NotaryService
{
    public function addFirstNumber(string $phone)
    {
        return "7{$phone}";
    }
}
