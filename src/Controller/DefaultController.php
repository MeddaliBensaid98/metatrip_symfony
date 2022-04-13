<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Entity\Sponsor;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/index", name="index")
     */
    public function index(): Response
    {
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    /**
     * @Route("/indexFront", name="indexFront")
     */
    public function indexFront(): Response
    {
        return $this->render('default/index.front.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    /**
     * @Route("/Myevents", name="Myevents")
     */
    public function Myevents(EntityManagerInterface $entityManager): Response
    {
        $evenements = $entityManager
            ->getRepository(Evenement::class)
            ->findAll();

      return $this->render('default/events.html.twig', [
            'evenements' => $evenements ,  ] ) ;

    }

    /**
     * @Route("/sponsors", name="sponsors")
     */
    public function sponsors(EntityManagerInterface $entityManager): Response
    {
        $sponsors = $entityManager
            ->getRepository(Sponsor::class)
            ->findAll();

        return $this->render('default/sponsors.html.twig', [
            'sponsors' => $sponsors,
        ]);
    }

    
}
