<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Entity\Sponsor;
use App\Entity\PropertySearch;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\PropertySearchType;


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
    public function Myevents(EntityManagerInterface $entityManager , Request $request): Response
    {

        //  Affichage par defaut

        $evenements = $entityManager
            ->getRepository(Evenement::class)
            ->findAll();

        $propertySearch = new PropertySearch();
        $form = $this->createForm(PropertySearchType::class,$propertySearch);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            // Search By Chanteur
            $chanteur = $propertySearch->getChanteur();
            if ($chanteur!="")
                // si ce nom est existe
                $evenements= $this->getDoctrine()->getRepository(Evenement::class)->findBy(['chanteur' => $chanteur] );

            else
                // si n'existe pas
                $evenements= $this->getDoctrine()->getRepository(Evenement::class)->findAll();


        }


      return $this->render('default/events.html.twig', [
            'form' => $form->createView(),
            'evenements' => $evenements

      ]  ) ;

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
