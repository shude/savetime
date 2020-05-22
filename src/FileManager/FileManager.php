<?php
/**
 * Yandex Direct API Library
 * Copyright 2020 Vladimir Tarkhanov <v@kekx.ru>
 *
 * 22.05.2020
 */

namespace App\FileManager;


use App\Entity\File;
use App\Entity\ImageFile;
use App\Hasher\FileHasherInterface;
use App\Repository\FileRepository;
use App\Repository\ImageFileRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileManager
{
    private FileHasherInterface $hasher;
    private ImageFileRepository $imageFileRepository;
    private FileRepository $fileRepository;
    private UploaderInterface $uploader;
    private EntityManagerInterface $em;

    public function __construct(
        FileHasherInterface $hasher,
        UploaderInterface $uploader,
        ImageFileRepository $imageFileRepository,
        FileRepository $fileRepository,
        EntityManagerInterface $em
    )
    {
        $this->hasher = $hasher;
        $this->imageFileRepository = $imageFileRepository;
        $this->fileRepository = $fileRepository;
        $this->uploader = $uploader;
        $this->em = $em;
    }

    public function upload(UploadedFile $uploadedFile) : ImageFile
    {
        $file_hash = $this->hasher->getHash($uploadedFile->getPathname());
        $file = $this->fileRepository->getByHash($file_hash);

        if(null === $file){
            $file = new File();
            $file->setHash($file_hash);
            $file->setName($this->uploader->upload($uploadedFile));
            $this->em->persist($file);
        }

        $imageFile = $this->imageFileRepository->getByOriginName($uploadedFile->getClientOriginalName());

        if(null === $imageFile){
            $imageFile = new ImageFile();
            $imageFile->setOriginName($uploadedFile->getClientOriginalName());
            $this->em->persist($imageFile);

        }

        $imageFile->setFile($file);
        $imageFile->setCreatedAt(new \DateTime());
        $this->em->flush();

        return $imageFile;

    }

}