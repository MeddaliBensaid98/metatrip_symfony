<?php

namespace App\Controller;

use App\Entity\ReservationVoyage;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StatistiqueController extends AbstractController
{
    /**
     * @Route("/statistique", name="app_statistique")
     */
    public function index(EntityManagerInterface $entityManager): Response

    { 
        $reservationVoyages = $entityManager
        ->getRepository(ReservationVoyage::class)
        ->findAll();
      
  
        
        $pays = [];
        $etat = [];
        $rd=0;
        $qu=0;
        $es=0;
        // On "démonte" les données pour les séparer tel qu'attendu par ChartJS
        foreach ($reservationVoyages as $rv)
        {
            if (  $rv->getEtat()=="NonPaye")  :

                $rd+=1;
            elseif ($rv->getEtat()=="Paye"):

                $qu+=1;
        
            endif;

        }
        
        //$l=sizeof($voyageOrganises);
          //echo "alert('$l');";
          $pieChart = new PieChart();
        $pieChart->getData()->setArrayToDataTable(
            [['Etat', 'NombreReservation'],
                ['NonPaye',     $rd],
                ['Paye',      $qu]
            ]);
        $pieChart->getOptions()->setColors(['#ffd700', '#C0C0C0', '#cd7f32']);

        $pieChart->getOptions()->setHeight(500);
        $pieChart->getOptions()->setWidth(900);
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#009900');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);
        
        return $this->render('statistique/index.html.twig',array('piechart' => $pieChart));
    }
}
