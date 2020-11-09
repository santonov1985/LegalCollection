<?php
namespace Core\Directories\Notaries;

class NotaryService
{
    public function addFirstNumber(string $phone = null)
    {
        if ($phone === null) {
            return null;
        }

        return "7{$phone}";
    }
}
