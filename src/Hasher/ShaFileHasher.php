<?php
/**
 * Yandex Direct API Library
 * Copyright 2020 Vladimir Tarkhanov <v@kekx.ru>
 *
 * 22.05.2020
 */

namespace App\Hasher;


class ShaFileHasher implements FileHasherInterface
{
    public function getHash(string $filePath): string
    {
        if(!file_exists($filePath)){
            throw new \InvalidArgumentException(
                sprintf("File: %s is not found.", $filePath)
            );
        }
        return hash_file('sha256', $filePath);
    }

}