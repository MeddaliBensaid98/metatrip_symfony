<?php

namespace App\Repository;

use App\Entity\Evenement;
use App\Entity\ReservationEvent;


use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

class ReservationEventRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ReservationEvent::class);
    }



    public function StatReservation(){
        $entityManager=$this->getEntityManager();
        $query=$entityManager
            ->createQuery('SELECT v.chanteur"chanteur",count(v.ide)"number" FROM App\Entity\Evenement v , App\Entity\ReservationEvent rv WHERE v.ide=rv.ide GROUP BY v.chanteur');

        return $query->getResult();
    }

    public function counting()
    {
        $entityManager=$this->getEntityManager();
        $query=$entityManager

            ->createQuery('SELECT COUNT(*) App\Entity\ReservationEvent');

        return $query->getResult();
    }


}
