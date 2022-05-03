<?php

namespace App\Repository;

use App\Entity\Evenement;
use App\Entity\ReservationHotel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


class EvenementsRepostitory extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ReservationHotel::class);
    }



  


    


    


    





}

