<?php

namespace App\Repository;

use App\Entity\ImageFile;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ImageFile|null find($id, $lockMode = null, $lockVersion = null)
 * @method ImageFile|null findOneBy(array $criteria, array $orderBy = null)
 * @method ImageFile[]    findAll()
 * @method ImageFile[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImageFileRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ImageFile::class);
    }

    public function getByOriginName(string $origin)
    {
        return $this->findOneBy(['origin_name' => $origin]);
    }
}
