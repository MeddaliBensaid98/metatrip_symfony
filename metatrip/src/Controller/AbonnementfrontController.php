<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AbonnementfrontController extends AbstractController
{
    /**
     * @Route("/abonnementfront", name="app_abonnementfront")
     */
    public function index(): Response
    {
        return $this->render('abonnementfront/index.html.twig', [
            'controller_name' => 'AbonnementfrontController',
        ]);
    }
}
