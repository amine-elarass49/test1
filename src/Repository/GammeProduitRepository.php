<?php

namespace App\Repository;

use App\Entity\GammeProduit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method GammeProduit|null find($gam_id, $lockMode = null, $lockVersion = null)
 * @method GammeProduit|null findOneBy(array $criteria, array $orderBy = null)
 * @method GammeProduit[]    findAll()
 * @method GammeProduit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GammeProduitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GammeProduit::class);
    }

    // /**
    //  * @return GammeProduit[] Returns an array of GammeProduit objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?GammeProduit
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
