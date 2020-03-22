<?php

namespace App\Repository;

use App\Entity\CatalogAuto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CatalogAuto|null find($id, $lockMode = null, $lockVersion = null)
 * @method CatalogAuto|null findOneBy(array $criteria, array $orderBy = null)
 * @method CatalogAuto[]    findAll()
 * @method CatalogAuto[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CatalogAutoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CatalogAuto::class);
    }

    // /**
    //  * @return CatalogAuto[] Returns an array of CatalogAuto objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CatalogAuto
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
