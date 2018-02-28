<?php

namespace App\Repository;

use App\Entity\Geomarkers;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Geomarkers|null find($id, $lockMode = null, $lockVersion = null)
 * @method Geomarkers|null findOneBy(array $criteria, array $orderBy = null)
 * @method Geomarkers[]    findAll()
 * @method Geomarkers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GeomarkersRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Geomarkers::class);
    }

    /*
    public function findBySomething($value)
    {
        return $this->createQueryBuilder('g')
            ->where('g.something = :value')->setParameter('value', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
}
