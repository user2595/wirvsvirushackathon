<?php

namespace App\Repository;

use App\Entity\PreExistingCondition;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method PreExistingCondition|null find($id, $lockMode = null, $lockVersion = null)
 * @method PreExistingCondition|null findOneBy(array $criteria, array $orderBy = null)
 * @method PreExistingCondition[]    findAll()
 * @method PreExistingCondition[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PreExistingConditionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PreExistingCondition::class);
    }

    // /**
    //  * @return PreExistingCondition[] Returns an array of PreExistingCondition objects
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
    public function findOneBySomeField($value): ?PreExistingCondition
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
