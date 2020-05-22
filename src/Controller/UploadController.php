<?php
/**
 * Yandex Direct API Library
 * Copyright 2020 Vladimir Tarkhanov <v@kekx.ru>
 *
 * 22.05.2020
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UploadController extends AbstractController
{
    /**
     * @Route("/upload", name="app.upload", methods={POST})
     * @param Request $request
     */
    public function uploadFile(Request $request)
    {

    }
}