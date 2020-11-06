<?php

namespace Core\Directories\Notaries;

class NotaryRepository
{
    public function createNotary(
        string $title,
        string $email = null,
        string $phone = null,
        string $description = null
    ): Notary
    {
        $notary = new Notary;
        $notary->title = $title;
        $notary->email = $email;
        $notary->phone = $phone;
        $notary->description = $description;
        $notary->saveOrFail();

        return $notary;
    }

    /**
     * Update notary
     *
     * @param Notary $notary
     * @param string $title
     * @param string|null $email
     * @param string|null $phone
     * @param string|null $description
     * @return Notary
     * @throws \Throwable
     */
    public function updateNotary(
        Notary $notary,
        string $title,
        string $email = null,
        string $phone = null,
        string $description = null
    ): Notary
    {
        $notary->title = $title;
        $notary->email = $email;
        $notary->phone = $phone;
        $notary->description = $description;
        $notary->saveOrFail();

        return $notary;
    }
}
