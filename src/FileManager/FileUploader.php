<?php
/**
 * Yandex Direct API Library
 * Copyright 2020 Vladimir Tarkhanov <v@kekx.ru>
 *
 * 22.05.2020
 */

namespace App\FileManager;


use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader implements UploaderInterface
{
    private $uploadsPath;

    public function __construct(string $uploadsPath)
    {
        $this->uploadsPath = $uploadsPath;
    }

    public function upload(UploadedFile $uploadedFile): string
    {
        $destination = $this->uploadsPath;
        $newFilename = uniqid() . '.' . $uploadedFile->getClientOriginalExtension();
        $uploadedFile->move(
            $destination,
            $newFilename
        );
        return $newFilename;
    }

}