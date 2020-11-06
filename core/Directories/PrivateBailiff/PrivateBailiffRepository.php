<?php

namespace Core\Directories\PrivateBailiff;

class PrivateBailiffRepository
{
    public function createPrivateBailiff(
        string $title,
        string $email = null,
        string $phone = null,
        string $description = null
    ): PrivateBailiff

    {
        $privateBailiff = new PrivateBailiff();
        $privateBailiff->title = $title;
        $privateBailiff->email = $email;
        $privateBailiff->phone = $phone;
        $privateBailiff->description = $description;
        $privateBailiff->saveOrFail();

        return $privateBailiff;
    }

    public function updatePrivateBailiff(
        PrivateBailiff $privateBailiff,
        string $title,
        string $email = null,
        string $phone = null,
        string $description = null
    ): PrivateBailiff

    {

        $privateBailiff->title = $title;
        $privateBailiff->email = $email;
        $privateBailiff->phone = $phone;
        $privateBailiff->description = $description;
        $privateBailiff->saveOrFail();

        return $privateBailiff;
    }
}
