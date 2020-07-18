<?php

namespace App\Repository;

use App\Entity\ProduitExtension;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProduitExtension|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProduitExtension|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProduitExtension[]    findAll()
 * @method ProduitExtension[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProduitExtensionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProduitExtension::class);
    }

    // /**
    //  * @return ProduitExtension[] Returns an array of ProduitExtension objects
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

    /*
    public function findOneBySomeField($value): ?ProduitExtension
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
