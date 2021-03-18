<?php

namespace App\Repository;

use App\Entity\ProduitsInput;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProduitsInput|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProduitsInput|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProduitsInput[]    findAll()
 * @method ProduitsInput[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProduitsInputRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProduitsInput::class);
    }

    // /**
    //  * @return ProduitsInput[] Returns an array of ProduitsInput objects
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
    public function findOneBySomeField($value): ?ProduitsInput
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
