<?php

namespace App\Repository;

use App\Entity\VoyageOrganise;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


class VoyageOrganiseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VoyageOrganise::class);
    }

  

    //Question 4-DQL
    public function findListaVoyages(){
        $entityManager=$this->getEntityManager();
        $query=$entityManager
            ->createQuery("SELECT v.idv,vo.idvo,vo.prixBillet,vo.nbplaces,vo.nbNuitees,vo.airline,vo.etatvoyage ,v.imagePays,v.pays FROM APP\Entity\VoyageOrganise vo,APP\Entity\Voyage v WHERE vo.idv=v.idv")
          ;
        return $query->getResult();
    }

    public function findByIdvoo(int $idv,int $idvo){
        $entityManager=$this->getEntityManager();
        $query=$entityManager
            ->createQuery('SELECT vo FROM APP\Entity\VoyageOrganise vo,APP\Entity\Voyage v WHERE  vo.idvo =:idvo AND vo.idv=v.idv  AND vo.idv =:idv')
            ->setParameter('idvo',$idvo)
            ->setParameter('idv',$idv);
        
        return $query->getOneOrNullResult();
    }



    public function findByNbPlaces(int $idvo,int $idv){
        $entityManager=$this->getEntityManager();
        $query=$entityManager
            ->createQuery("SELECT APP\Entity\VoyageOrganise vo

            FROM  APP\Entity\VoyageOrganise vo, APP\Entity\Voyage v, APP\Entity\ReservationVoyage rv
            WHERE rv.idv=vo.idv AND vo.idv=v.idv AND vo.idvo =:idvo AND vo.idv =:idv")
          
            ->setParameter('idvo',$idvo)
            ->setParameter('idv',$idv);
        
            return $query->getOneOrNullResult();
    }
}