<?php

namespace App\Repository;

use App\Entity\Sos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Sos|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sos|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sos[]    findAll()
 * @method Sos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sos::class);
    }

    // /**
    //  * @return Sos[] Returns an array of Sos objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Sos
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
