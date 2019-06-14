<?php

namespace App\Repository;

use App\Entity\TechnoPro;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TechnoPro|null find($id, $lockMode = null, $lockVersion = null)
 * @method TechnoPro|null findOneBy(array $criteria, array $orderBy = null)
 * @method TechnoPro[]    findAll()
 * @method TechnoPro[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TechnoProRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TechnoPro::class);
    }

    // /**
    //  * @return TechnoPro[] Returns an array of TechnoPro objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TechnoPro
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
