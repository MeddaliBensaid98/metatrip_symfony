<?php

namespace App\Repository;

use App\Entity\ReservationVoyage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use Doctrine\Persistence\ManagerRegistry;
class ReservationVoyageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ReservationVoyage::class);
    }

    public function orderByDateDepart()
    {
        return $this->createQueryBuilder('s')
            ->orderBy('s.dateDepart', 'ASC')
            ->getQuery()->getResult();
    }
   
    public function orderBydateArrivee()
    {
        return $this->createQueryBuilder('s')
            ->orderBy('s.dateArrivee', 'ASC')
            ->getQuery()->getResult();
    }

    
    public function orderByetat()
    {
        return $this->createQueryBuilder('s')
            ->orderBy('s.etat', 'ASC')
            ->getQuery()->getResult();
    }

 
    public function orderByRefpaiment()
    {
        return $this->createQueryBuilder('s')
            ->orderBy('s.refPaiement', 'ASC')
            ->getQuery()->getResult();
    }
}