<?php

namespace App\Repository;

use App\Entity\UserPersonalization;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method UserPersonalization|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserPersonalization|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserPersonalization[]    findAll()
 * @method UserPersonalization[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserPersonalizationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserPersonalization::class);
    }

    // /**
    //  * @return UserPersonalization[] Returns an array of UserPersonalization objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UserPersonalization
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
