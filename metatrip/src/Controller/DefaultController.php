<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/index", name="index")
     */
    public function index(): Response
    {$tst=0;
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
    
}
