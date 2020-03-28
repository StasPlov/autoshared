<?php

namespace App\Repository;

use App\Entity\AutoImage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method AutoImage|null find($id, $lockMode = null, $lockVersion = null)
 * @method AutoImage|null findOneBy(array $criteria, array $orderBy = null)
 * @method AutoImage[]    findAll()
 * @method AutoImage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AutoImageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AutoImage::class);
    }

    // /**
    //  * @return AutoImage[] Returns an array of AutoImage objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AutoImage
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
