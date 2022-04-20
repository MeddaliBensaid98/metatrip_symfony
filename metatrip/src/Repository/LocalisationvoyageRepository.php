<?php

namespace App\Repository;

use App\Entity\Localisationvoyage;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


class LocalisationvoyageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Localisationvoyage::class);
    }

    public function findCoordonne(){
        $entityManager=$this->getEntityManager();
        $query=$entityManager
            ->createQuery
        ("SELECT l.longitude,l.latitude,l.idl,v.idv,v.imagePays,v.pays,vo.etatvoyage,vo.nbplaces,vo.airline,vo.prixBillet

             FROM   App\Entity\Localisationvoyage l,App\Entity\Voyage v,App\Entity\VoyageOrganise vo
             WHERE v.idv=l.idv AND vo.idv=v.idv AND l.idv=vo.idv GROUP BY l.idl");
     
            return $query->getResult();
    }

}