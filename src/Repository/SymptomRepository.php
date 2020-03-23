<?php

namespace App\Repository;

use App\Entity\Symptom;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Symptom|null find($id, $lockMode = null, $lockVersion = null)
 * @method Symptom|null findOneBy(array $criteria, array $orderBy = null)
 * @method Symptom[]    findAll()
 * @method Symptom[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SymptomRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Symptom::class);
    }

    /**
     * @return Symptom[] Returns an array of Symptoms
     */
    public function findAllOrderedByName() {
        return $this->createQueryBuilder('symptom')
            ->orderBy('symptom.name', 'DESC')
        ;
    }

    /**
    * @return Symptom Returns the matching symptom
    */
    public function findById($id)
    {
        return $this->createQueryBuilder('symptom')
            ->andWhere('symptom.id = :id')
            ->setParameter('id', $id)
        ;
    }
}
