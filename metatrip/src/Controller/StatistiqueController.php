<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\ReservationVoyage;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\BarChart;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\LineChart;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StatistiqueController extends AbstractController
{
    /**
     * @Route("/statistique", name="app_statistique")
     */
    public function index(Session  $session,UserRepository $Rs,EntityManagerInterface $entityManager): Response

    { 
        $rvselondate = $Rs->Statselondate();
     
        $reservationVoyages = $entityManager
        ->getRepository(ReservationVoyage::class)
        ->findAll();
      
        $users = $entityManager
        ->getRepository(User::class)
        ->findAll();


        $nombre1=0;
        $nombre2=0;
        $nombre3=0;
        $nombre4=0;
        $nombre5=0;
        $nombre6=0;
        $nombre7=0;
        $nombre8=0;
        $nombre9=0;
        $nombre10=0;
        $nombre11=0;
        $nombre12 =0;
        $i=0;
        $max = sizeof($rvselondate);
 
        for ($i = 1; $i <= ($max-1) ; $i++) {
            if ($rvselondate[$i]['dated']=="1")  :

                $nombre1+=$rvselondate[$i]['nombre']; 
            elseif  ($rvselondate[$i]['dated']=="2")  :

                $nombre2+=$rvselondate[$i]['nombre'];
            elseif  ($rvselondate[$i]["dated"]=="3")  :
                $nombre3+=$rvselondate[$i]['nombre'];   
            elseif  ($rvselondate[$i]['dated']=="4")  :
                $nombre4+=$rvselondate[$i]['nombre'];
             elseif  ($rvselondate[$i]['dated']=="5")  :
                $nombre5+=$rvselondate[$i]['nombre'];
            elseif  ($rvselondate[$i]['dated']=="6")  :
                $nombre6+=$rvselondate[$i]['nombre'];
            elseif  ($rvselondate[$i]['dated']=="7")  :
                $nombre7+=$rvselondate[$i]['nombre'];
            elseif  ($rvselondate[$i]['dated']=="8")  :
                $nombre8+=$rvselondate[$i]['nombre'];
            elseif  ($rvselondate[$i]['dated']=="9")  :
                $nombre9+=$rvselondate[$i]['nombre'];
            elseif  ($rvselondate[$i]['dated']=="10")  :
                $nombre10+=$rvselondate[$i]['nombre'];
            elseif  ($rvselondate[$i]['dated']=="11")  :
                $nombre11+=$rvselondate[$i]['nombre'];
            elseif  ($rvselondate[$i]['dated']=="12")  :
                $nombre12+=$rvselondate[$i]['nombre'];
            endif;


        }













        
     
        $rd1=0;
        $qu1=0;
        $es1=0;
        // On "démonte" les données pour les séparer tel qu'attendu par ChartJS
      

        foreach ($users as $rv)
        {
            if (  $rv->getRole()==0)  :

                $rd1+=1;
            elseif ($rv->getRole()>0):

                $qu1+=1;
        
            endif;

        }


        $chart1 = new BarChart();
        $chart1->getData()->setArrayToDataTable(
       

 [[ "mois","nbReservation"],
 ['Janvier',   $nombre1],
 ['Février',   $nombre2],
 ['Mars',   $nombre3],
 ['Avril',   $nombre4],
 ['Mai',   $nombre5],
 ['Juin',   $nombre6],
 ['Juillet',   $nombre7],
 ['Août',   $nombre8],
 ['Septembre',   $nombre9],
 ['Octobre',   $nombre10],
 ['Novembre',   $nombre11],
 ['Décembre',   $nombre12],
 
 ] );
 $chart1->getOptions()->setColors(['#ffd700', '#C0C0C0', '#cd7f32']);

 $chart1->getOptions()->setHeight(500);
 $chart1->getOptions()->setWidth(900);
 $chart1->getOptions()->getTitleTextStyle()->setBold(true);
 $chart1->getOptions()->getTitleTextStyle()->setColor('#009900');
 $chart1->getOptions()->getTitleTextStyle()->setItalic(true);
 $chart1->getOptions()->getTitleTextStyle()->setFontName('Arial');
 $chart1->getOptions()->getTitleTextStyle()->setFontSize(20);

 
        $chart = new LineChart();
        $chart->getData()->setArrayToDataTable(
            [['Role', 'NombreUser'],
                ['User',     $rd1],
                ['Admin',      $qu1]
            ]);
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

        



        $chart->getOptions()->setColors(['#ffd700', '#C0C0C0', '#cd7f32']);

        $chart->getOptions()->setHeight(500);
        $chart->getOptions()->setWidth(900);
        $chart->getOptions()->getTitleTextStyle()->setBold(true);
        $chart->getOptions()->getTitleTextStyle()->setColor('#009900');
        $chart->getOptions()->getTitleTextStyle()->setItalic(true);
        $chart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $chart->getOptions()->getTitleTextStyle()->setFontSize(20);
        if( $session->get('login')=="true"){
        return $this->render('statistique/index.html.twig',array( 'rvselondate'=>$rvselondate[0]["dated"]  ,'piechart' => $pieChart,'chart'=>$chart,'chart1'=>$chart1));
    }else{
        return $this->redirectToRoute('security_login');
    }
    }
}