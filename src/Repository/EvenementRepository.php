<?php

namespace App\Repository;

use App\Entity\Evenement;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


class EvenementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Evenement::class);
    }

    public function findAllGreaterThanPrice(int $prix_e): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT p
            FROM App\Entity\Evenement p
            WHERE p.prix_e > :prix_e
            ORDER BY p.prix_e ASC'
        )->setParameter('prix_e', $price);

        // returns an array of Product objects
        return $query->getResult();
    }



}