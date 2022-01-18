<?php

namespace App\Repository;

use App\Entity\PreniumPost;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PreniumPost|null find($id, $lockMode = null, $lockVersion = null)
 * @method PreniumPost|null findOneBy(array $criteria, array $orderBy = null)
 * @method PreniumPost[]    findAll()
 * @method PreniumPost[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PreniumPostRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PreniumPost::class);
    }

    // /**
    //  * @return PreniumPost[] Returns an array of PreniumPost objects
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
    public function findOneBySomeField($value): ?PreniumPost
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
