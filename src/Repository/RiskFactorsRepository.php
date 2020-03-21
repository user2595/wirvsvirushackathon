<?php

namespace App\Repository;

use App\Entity\RiskFactors;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method RiskFactors|null find($id, $lockMode = null, $lockVersion = null)
 * @method RiskFactors|null findOneBy(array $criteria, array $orderBy = null)
 * @method RiskFactors[]    findAll()
 * @method RiskFactors[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RiskFactorsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RiskFactors::class);
    }

    // /**
    //  * @return RiskFactors[] Returns an array of RiskFactors objects
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
    public function findOneBySomeField($value): ?RiskFactors
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
