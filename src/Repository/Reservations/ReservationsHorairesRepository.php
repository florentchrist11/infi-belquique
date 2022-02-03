<?php

namespace App\Repository\Reservations;

use App\Entity\Reservations\ReservationsHoraires;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ReservationsHoraires|null find($id, $lockMode = null, $lockVersion = null)
 * @method ReservationsHoraires|null findOneBy(array $criteria, array $orderBy = null)
 * @method ReservationsHoraires[]    findAll()
 * @method ReservationsHoraires[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReservationsHorairesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ReservationsHoraires::class);
    }

    public function findFreeHour(ReservationsHoraires $reservationsHoraires): array
    {
        $debut = $reservationsHoraires->getStartAt()->format('H:i');
        $fin = $reservationsHoraires->getFinishAt()->format('H:i');
        $date = $reservationsHoraires->getDate()->format('Y-m-d');
        return $this->createQueryBuilder('r')
            ->andWhere('r.startAt = :debut')
            ->andWhere('r.finishAt = :fin')
            ->andWhere('r.date = :date')
            ->andWhere('r.statut = 1')
            ->setParameter('debut', $debut)
            ->setParameter('fin', $fin)
            ->setParameter('date', $date)
            ->getQuery()
            ->getResult();
    }


    // /**
    //  * @return ReservationsHoraires[] Returns an array of ReservationsHoraires objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ReservationsHoraires
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
