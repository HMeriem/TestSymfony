<?php

namespace App\Repository;

use App\Entity\ExoeriencePro;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ExoeriencePro|null find($id, $lockMode = null, $lockVersion = null)
 * @method ExoeriencePro|null findOneBy(array $criteria, array $orderBy = null)
 * @method ExoeriencePro[]    findAll()
 * @method ExoeriencePro[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExoerienceProRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ExoeriencePro::class);
    }

    // /**
    //  * @return ExoeriencePro[] Returns an array of ExoeriencePro objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ExoeriencePro
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
