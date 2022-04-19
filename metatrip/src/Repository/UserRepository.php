<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use Doctrine\Persistence\ManagerRegistry;

class UserRepository extends ServiceEntityRepository implements UserLoaderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function loadUserByUsername($username)
    {
        return $this->createQueryBuilder('u')
            ->where('u.username = :username OR u.email = :email')
            ->setParameter('username', $username)
            ->setParameter('email', $username)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findByIdu(int $idu){
        $entityManager=$this->getEntityManager();
        $query=$entityManager
            ->createQuery('SELECT u FROM APP\Entity\User u WHERE u.idu =:idu')
            ->setParameter('idu',$idu);
      
        
        return $query->getOneOrNullResult();
    }

    
    public function StatReservation(){
        $entityManager=$this->getEntityManager();
        $query=$entityManager
            ->createQuery('SELECT v.pays"pays",count(v.idv)"number" FROM App\Entity\Voyage v , App\Entity\ReservationVoyage rv WHERE v.idv=rv.idv GROUP BY v.pays');
      
            return $query->getResult();
    }

    
    
    public function Statselondate():array{
        $entityManager=$this->getEntityManager();
        $query=$entityManager
            ->createQuery("SELECT   MONTH(rv.dateDepart) as dated , count(rv.dateArrivee)  AS nombre  FROM App\Entity\ReservationVoyage rv GROUP BY  rv.dateDepart");
   
            return $query->getResult();
    }
        }
     