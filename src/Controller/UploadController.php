<?php
/**
 * Yandex Direct API Library
 * Copyright 2020 Vladimir Tarkhanov <v@kekx.ru>
 *
 * 22.05.2020
 */

namespace App\Controller;


use App\Entity\File;
use App\Entity\ImageFile;
use App\FileManager\FileManager;
use App\FileManager\FileManagerInterface;
use App\FileManager\UploaderInterface;
use App\Hasher\FileHasherInterface;
use App\ImageValidator\ImageValidator;
use App\Repository\FileRepository;
use App\Repository\ImageFileRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UploadController extends AbstractController
{
    /**
     * @Route("/upload", name="app.upload", methods={"POST"})
     * @param Request $request
     * @param FileManager $fileManager
     * @param ImageValidator $validator
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function uploadFile(
        Request $request,
        FileManager $fileManager,
        ImageValidator $validator
    )
    {
        /** @var UploadedFile $uploadedFile */
        $uploadedFile = $request->files->get('image');

        if(false === $validator->validate($uploadedFile)){
            return $this->json([
                'error_text' => $validator->getError()
            ]);
        }

        $imageFile = $fileManager->upload($uploadedFile);
        return $this->json(['file_id' => $imageFile->getId()]);
    }

    /**
     * @Route("/file/{fid}", name="app.fileinfo", methods={"GET"})
     * @param int $fid
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function info(int $fid)
    {
        /** @var ImageFile $im */
        $im = $this->getDoctrine()
            ->getRepository(ImageFile::class)
            ->find($fid);

        if(null === $im){
            return $this->json([],404);
        }else{
            return $this->json([
                'file_id' => $im->getId(),
                'origin_name' => $im->getOriginName(),
                'created_at' => $im->getCreatedAt()->format('Y-m-d H:i:s')
            ]);
        }
    }
}