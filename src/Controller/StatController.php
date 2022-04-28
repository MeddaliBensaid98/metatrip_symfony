<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Entity\ReservationEvent;
use App\Entity\User;


use App\Repository\EvenementRepository;
use App\Repository\ReservationEventRepository;
use App\Repository\UserRepository;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;


use Ob\HighchartsBundle\Highcharts\Highchart;

use Doctrine\ORM\EntityManagerInterface;


use CMEN\GoogleChartsBundle\GoogleCharts\Charts\BarChart;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\LineChart;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\TableChart;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\OrgChart;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\Material\ColumnChart ;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

class StatController extends AbstractController
{


    /**
     * @Route("/stat", name="stat_events", methods={"GET"})
     */
    public function index2(EntityManagerInterface $entityManager,EvenementRepository $repo): Response
    {




        $lista=$repo->stat();
        $lista2=$repo->stat2();


        $n=sizeof($lista);



        return $this->render('statistique/index.html.twig', [
            'lista' => $lista,
            'lista2' => $lista2,
            'n'=>$n

        ]);
    }




}
