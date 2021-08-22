<?php

namespace App\Repository;

use App\Entity\Contacts;
use App\Entity\ContactSearch;
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

    /**
     * @return Query Returns an array of Contacts objects
     */

    public function findAllMyContacts(): Query
    {
        return $this->findAllQuery()
        ->orderBy('c.id', 'DESC')
        ->getQuery();
    }


    // /**
    //  * @return Query Returns an array of Contacts objects
    //  */

    public function findAllMyContactsByName(ContactSearch $search): Query
    {
        $query = $this->findAllQuery();
        
        if($search->getName()){
            $arrayname = explode(" ", $search->getName());
            for($i = 0; $i < count($arrayname); $i++){
               $query->orWhere('c.firstname = :name'.$i)
                            ->orWhere('c.lastname = :name'.$i)
                            ->orderBy('c.id', 'DESC')
                            ->setParameter('name'.$i, $arrayname[$i]);
            }
            dump($arrayname);
        }

        return $query->getQuery();
    }

    /**
     * @return QueryBuilder 
     */

    private function findAllQuery (): QueryBuilder
    {
        return $this->createQueryBuilder('c');
    }
}
