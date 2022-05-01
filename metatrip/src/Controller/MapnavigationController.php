<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MapnavigationController extends AbstractController
{
    /**
     * @Route("/mapnavigation", name="app_mapnavigation")
     */
    public function index(): Response
    {
        return $this->render('MapNaviguation/index.html.twig', [
            'controller_name' => 'MapnavigationController',
        ]);
    }
}