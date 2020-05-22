<?php
/**
 * Yandex Direct API Library
 * Copyright 2020 Vladimir Tarkhanov <v@kekx.ru>
 *
 * 22.05.2020
 */

namespace App\FileUploader;


use Symfony\Component\HttpFoundation\File\UploadedFile;

interface UploaderInterface
{
    /**
     * Upload a file and return uploaded file path
     * @param UploadedFile $uploadedFile
     * @return string
     */
    public function upload(UploadedFile $uploadedFile) : string;
}