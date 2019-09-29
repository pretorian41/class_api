<?php

namespace App\Repository;

use App\Entity\AppClass;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method AppClass|null find($id, $lockMode = null, $lockVersion = null)
 * @method AppClass|null findOneBy(array $criteria, array $orderBy = null)
 * @method AppClass[]    findAll()
 * @method AppClass[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AppClassRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AppClass::class);
    }
}
