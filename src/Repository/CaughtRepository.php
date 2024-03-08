<?php

namespace App\Repository;

use App\Entity\Caught;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Caught>
 *
 * @method Caught|null find($id, $lockMode = null, $lockVersion = null)
 * @method Caught|null findOneBy(array $criteria, array $orderBy = null)
 * @method Caught[]    findAll()
 * @method Caught[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CaughtRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Caught::class);
    }

//    /**
//     * @return Caught[] Returns an array of Caught objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Caught
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
