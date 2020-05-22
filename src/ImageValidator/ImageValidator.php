<?php
/**
 * Yandex Direct API Library
 * Copyright 2020 Vladimir Tarkhanov <v@kekx.ru>
 *
 * 22.05.2020
 */

namespace App\ImageValidator;


use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ImageValidator
{
    private ValidatorInterface $validator;
    private $errors;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    public function validate(UploadedFile $uploadedFile)
    {
        $this->errors = $this->validator->validate(
            $uploadedFile,
            new Image(['maxSize' => '10M'])
        );

        if(count($this->errors) > 0) return false;

        $this->errors = $this->validator->validate(
            $uploadedFile->getClientOriginalExtension(),
            new Regex([
                'pattern' => '/^(jpe?g|png)$/ui',
                'message' => 'This file type is not allowed'
            ])
        );

        return count($this->errors) === 0;

    }

    public function getError() : ?string
    {
        return $this->errors[0]->getMessage();
    }
}