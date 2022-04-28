<?php

namespace App\Repository;

use App\Entity\Evenement;
use App\Entity\ReservationEvent;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


class EvenementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Evenement::class);
    }



    public function findByIde(int $ide){
        $entityManager=$this->getEntityManager();
        $query=$entityManager
            ->createQuery('SELECT e FROM APP\Entity\Evenement e WHERE e.ide =:ide')
            ->setParameter('ide',$ide);


        return $query->getOneOrNullResult();
    }


    public function findListaevenements(){
        $entityManager=$this->getEntityManager();
        $query=$entityManager
            ->createQuery("SELECT v.ide,vo.chanteur,vo.date_event FROM APP\Entity\Evenement vo,APP\Entity\ReservationEvent v WHERE vo.ide=v.ide")
        ;
        return $query->getResult();
    }


    // Find/search articles by title/content
    public function findArticlesByName(string $query)
    {
        $qb = $this->createQueryBuilder('p');
        $qb
            ->where(
                $qb->expr()->andX(
                    $qb->expr()->orX(
                        $qb->expr()->like('p.chanteur', ':query'),
                        $qb->expr()->like('p.type_event', ':query'),
                    ),
                    $qb->expr()->isNotNull('p.date_event')
                )
            )
            ->setParameter('query', '%' . $query . '%')
        ;
        return $qb
            ->getQuery()
            ->getResult();
    }


    //  TRIE PAR CHANTEUR/Prix_e/
    /**
     * Requête QueryBuilder
     * */
    public function orderByChanteur()
    {
        return $this->createQueryBuilder('s')
            ->orderBy('s.chanteur', 'ASC')
            ->getQuery()->getResult();
    }

    public function orderByPrix()
    {
        return $this->createQueryBuilder('s')
            ->orderBy('s.prixE', 'ASC')
            ->getQuery()->getResult();
    }






    public function Statselondate():array{
        $entityManager=$this->getEntityManager();
        $query=$entityManager
            ->createQuery("SELECT MONTH (rv.date_event) as dated , count(rv.date_event)  AS nombre  FROM App\Entity\Evenement rv GROUP BY  rv.date_event");

        return $query->getResult();
    }



    public function search($chanteur) {
        return $this->createQueryBuilder('evenement')
            ->andWhere('evenement.chanteur LIKE :chanteur')
            ->setParameter('title', '%'.$title.'%')
            ->getQuery()
            ->execute();
    }


    public function stat2(){
        $entityManager=$this->getEntityManager();
        $query=$entityManager
            ->createQuery("SELECT count(rv.ide) as e,v.chanteur,count(rv.idrev) as nb
            FROM  App\Entity\Evenement v, App\Entity\ReservationEvent rv 
            WHERE  v.ide=rv.ide GROUP BY v.ide ORDER BY count(rv.idrev) ASC");


        return $query->getResult();
    }



    public function stat(){
        $entityManager=$this->getEntityManager();
        $query=$entityManager
            ->createQuery("SELECT count(rv.idu) as u,v.chanteur,count(rv.ide) as nb
            FROM  App\Entity\Evenement v, App\Entity\ReservationEvent rv 
            WHERE  v.ide=rv.ide GROUP BY v.ide  ");


        return $query->getResult();
    }




}

