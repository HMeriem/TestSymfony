<?php

namespace App\Repository;

use App\Entity\JoinExpCompetenceTechno;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method JoinExpCompetenceTechno|null find($id, $lockMode = null, $lockVersion = null)
 * @method JoinExpCompetenceTechno|null findOneBy(array $criteria, array $orderBy = null)
 * @method JoinExpCompetenceTechno[]    findAll()
 * @method JoinExpCompetenceTechno[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JoinExpCompetenceTechnoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, JoinExpCompetenceTechno::class);
    }

    // /**
    //  * @return JoinExpCompetenceTechno[] Returns an array of JoinExpCompetenceTechno objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('j.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?JoinExpCompetenceTechno
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
