<?php

namespace App\Repository;

use App\Entity\CompetencePro;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CompetencePro|null find($id, $lockMode = null, $lockVersion = null)
 * @method CompetencePro|null findOneBy(array $criteria, array $orderBy = null)
 * @method CompetencePro[]    findAll()
 * @method CompetencePro[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompetenceProRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CompetencePro::class);
    }

    // /**
    //  * @return CompetencePro[] Returns an array of CompetencePro objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CompetencePro
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
