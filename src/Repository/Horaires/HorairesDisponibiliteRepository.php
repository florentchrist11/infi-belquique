<?php

namespace App\Repository\Horaires;

use App\Entity\Horaires\HorairesDisponibilite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method HorairesDisponibilite|null find($id, $lockMode = null, $lockVersion = null)
 * @method HorairesDisponibilite|null findOneBy(array $criteria, array $orderBy = null)
 * @method HorairesDisponibilite[]    findAll()
 * @method HorairesDisponibilite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HorairesDisponibiliteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HorairesDisponibilite::class);
    }

    public function findValid(int $day, $time)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.jour  = :day')
            ->andWhere('h.startAt  = :time')
            ->setParameter('day', $day)
            ->setParameter('time', $time)
            ->setMaxResults(1)
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return HorairesDisponibilite[] Returns an array of HorairesDisponibilite objects
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
    public function findOneBySomeField($value): ?HorairesDisponibilite
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
