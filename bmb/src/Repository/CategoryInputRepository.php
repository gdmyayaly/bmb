<?php

namespace App\Repository;

use App\Entity\CategoryInput;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CategoryInput|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategoryInput|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategoryInput[]    findAll()
 * @method CategoryInput[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryInputRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategoryInput::class);
    }

    // /**
    //  * @return CategoryInput[] Returns an array of CategoryInput objects
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
    public function findOneBySomeField($value): ?CategoryInput
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
