<?php

namespace App\Controller;

use App\Repository\CalendarRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ReservationHotelRepository;
use App\Entity\ReservationHotel;
use CMEN\GoogleChartsBundle\GoogleCharts\Options\CalendarChart\Calendar;

class CalendarController extends AbstractController
{
    /**
     * @Route("/calendar", name="app_calendar")
     * 
     */
     public function index(CalendarRepository $calendarRepository): Response
    {
        return $this->render('calendar/index.html.twig', [
            'calendars' => $calendarRepository->findAll(),
        ]);
    }
    

  /**
    * @Route("/calendarn", name="calendar_show", methods={"GET"})
    */
   public function show(Calendar $calendar): Response
   {
       return $this->render('calendar/show.html.twig', [
           'calendar' => $calendar,
       ]);
   }
    public function fullCalendar(ReservationHotelRepository  $calendar)
    {
        $events = $calendar->findAll();

        $rdv = [];

        foreach($events as $event){
            $rdv[] = [
                'id' => $event->getIdrh(),
                'start' => $event->getDateDepart()->format('Y-m-d H:i:s'),
                'end' => $event->getDateArrivee(),
                'title' => $event->getNbNuitees(),
                'description'=> ("Reservation"),
            


            ];
        }

        $data = json_encode($rdv);

        return $this->render('calendar/index.html.twig', ['data' => $data,]);
    }
  
}
