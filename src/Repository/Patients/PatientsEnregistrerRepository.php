<?php

namespace App\Repository\Patients;

use App\Entity\Patients\PatientsEnregistrer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PatientsEnregistrer|null find($id, $lockMode = null, $lockVersion = null)
 * @method PatientsEnregistrer|null findOneBy(array $criteria, array $orderBy = null)
 * @method PatientsEnregistrer[]    findAll()
 * @method PatientsEnregistrer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PatientsEnregistrerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PatientsEnregistrer::class);
    }

    // /**
    //  * @return PatientsEnregistrer[] Returns an array of PatientsEnregistrer objects
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
    public function findOneBySomeField($value): ?PatientsEnregistrer
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
