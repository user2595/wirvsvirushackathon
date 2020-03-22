<?php

namespace App\Repository;

use App\Entity\PatientSymptom;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method PatientSymptom|null find($id, $lockMode = null, $lockVersion = null)
 * @method PatientSymptom|null findOneBy(array $criteria, array $orderBy = null)
 * @method PatientSymptom[]    findAll()
 * @method PatientSymptom[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PatientSymptomRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PatientSymptom::class);
    }

    // /**
    //  * @return PatientSymptom[] Returns an array of PatientSymptom objects
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
    public function findOneBySomeField($value): ?PatientSymptom
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
