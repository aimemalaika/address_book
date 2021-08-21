<?php

namespace App\Repository;

use App\Entity\Emails;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Emails|null find($id, $lockMode = null, $lockVersion = null)
 * @method Emails|null findOneBy(array $criteria, array $orderBy = null)
 * @method Emails[]    findAll()
 * @method Emails[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmailsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Emails::class);
    }

    // /**
    //  * @return Emails[] Returns an array of Emails objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Emails
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
