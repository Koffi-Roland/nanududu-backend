<?php

namespace App\Repository;

use App\Entity\Publication;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Publication|null find($id, $lockMode = null, $lockVersion = null)
 * @method Publication|null findOneBy(array $criteria, array $orderBy = null)
 * @method Publication[]    findAll()
 * @method Publication[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PublicationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Publication::class);
    }

     /**
      * @return Publication[] Returns an array of Publication objects
      */
    
    public function findByLastPublication()
    {
        return $this->createQueryBuilder('p')
            ->orderBy('p.id', 'DESC')
            ->setMaxResults(8)
            ->getQuery()
            ->getResult() ;
    }



      /**
      * @return Publication[] Returns an array of Publication objects
      */
    
      public function findByUserPublication($personne)
      {
          return $this->createQueryBuilder('p')
              ->andWhere('p.personnePhysique = :personne')
              ->setParameter('val', $personne)
              ->orderBy('p.id', 'DESC')
              ->getQuery()
              ->getResult()
          ;
      }
    

    /*
    public function findOneBySomeField($value): ?Publication
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
