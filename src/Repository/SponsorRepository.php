<?php

namespace App\Repository;

use App\Entity\Sponsor;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


class SponsorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sponsor::class);
    }



    public function findByIde(int $ids){
        $entityManager=$this->getEntityManager();
        $query=$entityManager
            ->createQuery('SELECT e FROM APP\Entity\Sponsor e WHERE e.ids =:ids')
            ->setParameter('ids',$ids);


        return $query->getOneOrNullResult();
    }



    //  TRIE PAR NOMSPONSOR/Prix_S/
    /**
     * Requête QueryBuilder
     * */
    public function orderByNomSponsor()
    {
        return $this->createQueryBuilder('s')
            ->orderBy('s.nomsponsor', 'ASC')
            ->getQuery()->getResult();
    }

}

