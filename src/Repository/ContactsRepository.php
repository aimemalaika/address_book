<?php

namespace App\Repository;

use App\Entity\Contacts;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Contacts|null find($id, $lockMode = null, $lockVersion = null)
 * @method Contacts|null findOneBy(array $criteria, array $orderBy = null)
 * @method Contacts[]    findAll()
 * @method Contacts[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContactsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Contacts::class);
    }

    // /**
    //  * @return Contacts[] Returns an array of Contacts objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /**
     * @return Query Returns an array of Contacts objects
     */

    public function findAllMyContacts(): Query
    {
        return $this->findAllQuery('c')
        ->orderBy('c.id', 'DESC')
        ->getQuery();
    }

    // /**
    //  * @return Contacts[] Returns an array of Contacts objects
    //  */
    // public function findMyContacts() : array
    // {
    //     return $this->findAllQuery('c')
    //         ->getQuery()
    //         ->getResult()
    //     ;
    // }

    /**
     * @return QueryBuilder 
     */

    private function findAllQuery (): QueryBuilder
    {
        return $this->createQueryBuilder('c');
    }
    
    /*
    public function findOneBySomeField($value): ?Contacts
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
