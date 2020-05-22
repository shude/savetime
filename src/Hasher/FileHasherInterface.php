<?php
/**
 * Yandex Direct API Library
 * Copyright 2020 Vladimir Tarkhanov <v@kekx.ru>
 *
 * 22.05.2020
 */

namespace App\Hasher;


interface FileHasherInterface
{
    public function getHash(string $filePath) : string;
}