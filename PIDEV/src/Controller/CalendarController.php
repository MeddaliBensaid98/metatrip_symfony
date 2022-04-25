<?php

namespace App\Controller;

use App\Repository\CalendarRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\ReservationHotel;

class CalendarController extends AbstractController
{
    /**
     * @Route("/calendar", name="app_calendar")
     */
    public function index(CalendarRepository $calendar): Response
    {
      
        $events = $calendar->findAll();

        $rdvs = [];

        foreach($events as $event){
            $rdvs[] = [
                
            
            ];
        }

        $data = json_encode($rdvs);

        return $this->render('calendar/index.html.twig',compact('data') );
            
     
    }
}
