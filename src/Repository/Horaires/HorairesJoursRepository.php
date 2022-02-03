<?php

namespace App\Repository\Horaires;

use App\Entity\Horaires\HorairesJours;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method HorairesJours|null find($id, $lockMode = null, $lockVersion = null)
 * @method HorairesJours|null findOneBy(array $criteria, array $orderBy = null)
 * @method HorairesJours[]    findAll()
 * @method HorairesJours[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HorairesJoursRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HorairesJours::class);
    }

    // /**
    //  * @return HorairesJours[] Returns an array of HorairesJours objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?HorairesJours
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
