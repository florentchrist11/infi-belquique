<?php

namespace App\Repository\Actes;

use App\Entity\Actes\ActesCategories;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ActesCategories|null find($id, $lockMode = null, $lockVersion = null)
 * @method ActesCategories|null findOneBy(array $criteria, array $orderBy = null)
 * @method ActesCategories[]    findAll()
 * @method ActesCategories[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActesCategoriesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ActesCategories::class);
    }

    // /**
    //  * @return ActesCategories[] Returns an array of ActesCategories objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ActesCategories
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
