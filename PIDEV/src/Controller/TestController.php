<?php

namespace App\Controller;

use App\Entity\Activites;
use Cassandra\Date;

use Knp\Component\Pager\PaginatorInterface;
use mysql_xdevapi\Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Abonnement;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\GeoChart;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\WordTree;
use Symfony\Component\Validator\Constraints\DateTime;
use Dompdf\Dompdf;
use Dompdf\Options;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\ComboChart;
use CMEN\GoogleChartsBundle\GoogleCharts\Options\VAxis;


use Symfony\Component\Form\FormBuilderInterface;
use App\Entity\Article;
use App\Repository\AbonnementeRepository;
use App\Form\AbonnementType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\File\File;


class TestController extends AbstractController
{
    /**
     * @Route("/aaaaali", name="app_test")
     */
    public function index(): Response
    {
        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }

    /**
     * @Route("/statsTypeAbonnement", name="statzakazikou1")
     */
    public function new(): Response
    { $repository = $this->getDoctrine()->getRepository(Abonnement::class);
        $abonnements = $repository->findAll();
        $em = $this->getDoctrine()->getManager();

        $rd=0;
        $qu=0;
        $es=0;


        foreach ($abonnements as $abonnements)
        {
            if (  $abonnements->getType()=="Gold")  :

                $rd+=1;
            elseif ($abonnements->getType()=="Silver"):

                $qu+=1;
            else :
                $es +=1;

            endif;

        }


        $pieChart = new PieChart();
        $pieChart->getData()->setArrayToDataTable(
            [['Type', 'nombres'],
                ['Gold',     $rd],
                ['Silver',      $qu],
                ['Bronse',   $es]
            ]
        );
        $pieChart->getOptions()->setColors(['#ffd700', '#C0C0C0', '#cd7f32']);

        $pieChart->getOptions()->setHeight(500);
        $pieChart->getOptions()->setWidth(900);
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#009900');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);

        return $this->render('abonnement/stat.html.twig', array('piechart' => $pieChart));

    }

    /**
     * @Route("/geo", name="geo")
     */
    public function geo(): Response{
        $wordTree = new WordTree();
        $wordTree->getData()->setArrayToDataTable(
            [ ['Phrases'],
                ['cats are better than dogs'],
                ['cats eat kibble'],
                ['cats are better than hamsters'],
                ['cats are awesome'],
                ['cats are people too'],
                ['cats eat mice'],
                ['cats meowing'],
                ['cats in the cradle'],
                ['cats eat mice'],
                ['cats in the cradle lyrics'],
                ['cats eat kibble'],
                ['cats for adoption'],
                ['cats are family'],
                ['cats eat mice'],
                ['cats are better than kittens'],
                ['cats are evil'],
                ['cats are weird'],
                ['cats eat mice'],
            ]
        );
        $wordTree->getOptions()->getWordtree()->setFormat('implicit');
        $wordTree->getOptions()->getWordtree()->setWord('cats');
        $wordTree->getOptions()->setFontName('Times-Roman');
        $wordTree->getOptions()->setWidth(900);
        $wordTree->getOptions()->setHeight(500);
        return $this->render('abonnement/stat2.html.twig', array('piechart' => $wordTree));


    }


    /**
     * @Route("/Liste", name="Liste")
     */
    public function Liste(){
        $repository=$this->getDoctrine()->getRepository(Abonnement::class);
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        $abonnement=$repository->findall();


        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('abonnement/liste.html.twig',
            ['abonnement'=>$abonnement]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("Liste_des_abonnements.pdf", [
            "Attachment" => true
        ]);


    }

    /**
     * @Route("/StatChiffreAffaire", name="statzakazikou")
     */
    public function statA()
    {
        $repository = $this->getDoctrine()->getRepository(Abonnement::class);
        $abonnements = $repository->findAll();
        $em = $this->getDoctrine()->getManager();


        $CaJ=0;
        $CaJ0=30000;
        $EJ=0.0;


        $CaF=0;
        $CaF0=40000;
        $EF=0.0;

        $CaM=0;
        $CaM0=45000;
        $EM=0.0;



        $CaA=0;
        $CaA0=40000;
        $EA=0;

        $CaMai=0;
        $CaMai0=60000;
        $EMai=0;


        $CaJuin=0;
        $CaJuin0=40000;
        $EJuin=0;

        $CaJuillet=0;
        $CaJuillet0=25000;
        $EJuillet=0;



        $CaAout=0;
        $CaAout0=28000;
        $EAout=0;


        $CaS=0;
        $CaS0=30000;
        $ES=0;


        $CaO=0;
        $CaO0=32000;
        $EO=0.0;


        $CaN=0;
        $CaN0=12000;
        $EN=0.0;


        $CaD=0;
        $CaD0=34000;
        $ED=0.0;





        foreach ($abonnements as $abonnements) {
            if ($abonnements->getDateAchat()->format('m') == 01)      :

                $CaJ = $abonnements->getPrixA() + $CaJ;
                $EJ = (( $CaJ - $CaJ0 ) / $CaJ0) * 100;

                elseif ($abonnements->getDateAchat()->format('m') == 02)  :

                    $CaF = $abonnements->getPrixA() + $CaF;
                    $EF = (( $CaF - $CaF0 ) / $CaF0 ) * 100;


            elseif ($abonnements->getDateAchat()->format('m') == 03)  :

                $CaM = $abonnements->getPrixA() + $CaM;
                $EM = (( $CaM - $CaM0 ) / $CaM0) * 100;




            elseif ($abonnements->getDateAchat()->format('m') == 04)  :

                $CaA = $abonnements->getPrixA() + $CaA;
                $EA = (( $CaA - $CaA0 ) / $CaA0 ) * 100;


            elseif ($abonnements->getDateAchat()->format('m') == 05)  :

                $CaMai = $abonnements->getPrixA() + $CaMai;
                $EMai = (( $CaMai - $CaMai0 ) / $CaMai0 ) * 100;

            elseif ($abonnements->getDateAchat()->format('m') == 06)  :

                $CaJuin = $abonnements->getPrixA() + $CaJuin;
                $EJuin = (( $CaJ - $CaJ0 ) / $CaJ0 ) * 100;


            elseif ($abonnements->getDateAchat()->format('m') == 07)  :

                $CaJuillet = $abonnements->getPrixA() + $CaJuillet;
                $EJuillet = (( $CaJuillet - $CaJuillet0 ) / $CaJuillet0) * 100;


            elseif ($abonnements->getDateAchat()->format('m') == 8)   :

                $CaAout = $abonnements->getPrixA() + $CaAout;
                $EAout = (( $CaAout - $CaAout0 ) / $CaAout0) * 100;


            elseif ($abonnements->getDateAchat()->format('m') == 9)  :

                $CaS = $abonnements->getPrixA() + $CaS;
                $ES = (( $CaS - $CaS0 ) / $CaS0) * 100;



            elseif ($abonnements->getDateAchat()->format('m') == 10)  :

                $CaO = $abonnements->getPrixA() + $CaO;
                $EO = (( $CaO - $CaO0 ) / $CaO0) * 100;



            elseif ($abonnements->getDateAchat()->format('m') == 11)  :

                $CaN = $abonnements->getPrixA() + $CaN;
                $EN = (( $CaN - $CaN0 ) / $CaN0 ) * 100;


            elseif ($abonnements->getDateAchat()->format('m') == 12)  :

                $CaD = $abonnements->getPrixA() + $CaD;
                $ED = (( $CaD - $CaD0 ) / $CaD0 ) * 100;




            endif;
        }





        $chart = new ComboChart();


        $chart->getData()->setArrayToDataTable(
            [   ['Month', 'Income 2022', ['role' => 'tooltip'], 'Income 2021', ['role' => 'tooltip'], 'Evolution', ['role' => 'tooltip'] ],
                ["Janvier", $CaJ, "$CaJ DT", $CaJ0, "$CaJ0 DT",$EJ, "$EJ %"],
                ["Fevrier", $CaF, "$CaF DT", $CaF0, "$CaF0 DT", $EF, "$EF %"],
                ["Mars", $CaM, "$CaM DT", $CaM0,"$CaM0 DT",$EM, "$EM %"],
                ["Avril", $CaA, "$CaA DT", $CaA0, "$CaA0 DT",$EA, "$EA %"],
                ["Mai", $CaMai, "$CaMai DT", $CaMai,"$CaMai0 DT",$EMai, "$EMai %"],
                ["Juin", $CaJuin, "$CaJuin DT", $CaJuin0,"$CaJuin0 DT",$EJuin, "$EJuin %"],
                ["Juillet", $CaJuillet, "$CaJuillet DT", $CaJuillet0,"$CaJuillet0 DT",$EJuillet, "$EJuillet %"],
                ["Aout", $CaAout, "$CaAout DT", $CaAout0, "$CaAout0 DT",$EAout, "$EAout %"],
                ["Septembre", $CaS, "$CaS DT", $CaS0, "$CaS0 DT",$ES, "$ES %"],
                ["Octobre", $CaO, "$CaO DT", $CaO0, "$CaO0 DT",$EO, "$EO %"],
                ["Novembre", $CaN, "$CaN DT", $CaN0,"$CaN0 DT",$EN, "$EN %"],
                ["Decembre", $CaD, "$CaD DT", $CaD0,"$CaD0 DT",$ED, "$ED %"],




            ]
        );





        $chart->getOptions()->setHeight(600);
        $chart->getOptions()->setWidth(900);
        $chart->getOptions()->getTooltip()->getTextStyle()->setBold(true);



        /* Income */
        $series1 = new \CMEN\GoogleChartsBundle\GoogleCharts\Options\ComboChart\Series();
        $series1->setType('bars');
        $series1->setTargetAxisIndex(0);
        $series1->setColor('#008000');

        /* Cost */
        $series2 = new \CMEN\GoogleChartsBundle\GoogleCharts\Options\ComboChart\Series();
        $series2->setType('bars');
        $series2->setTargetAxisIndex(0);
        $series2->setColor('#ff0000');

        /* Evolution */
        $series3 = new \CMEN\GoogleChartsBundle\GoogleCharts\Options\ComboChart\Series();
        $series3->setType('line');
        $series3->setTargetAxisIndex(1);
        $series3->setColor('#f6dc12');

        $chart->getOptions()->setSeries([$series1, $series2, $series3]);

        $chart->getOptions()->getHAxis()->setTitle('Mois');

        return $this->render('abonnement/stat2.html.twig', array('piechart' => $chart));


    }


    /**
     * @Route("/bot", name="botzakazikou")
     */
    public function bot( \Swift_Mailer $mailer): Response
    { $repository = $this->getDoctrine()->getRepository(Abonnement::class);
        $abonnements = $repository->findAll();
        $em = $this->getDoctrine()->getManager();

        $compteur=0;


        foreach ($abonnements as $abonnements)
        {
            $now = time();
            $date2 = strtotime( $abonnements->getDateExpiration()->format('d-m-Y'));
           $diff = abs($date2 - $now); // abs pour avoir la valeur absolute, ainsi éviter d'avoir une différence négative

            try {

                if ($diff < 259200) :
                    $alo=$abonnements->getIdu()->getEmail();
                    $message = (new \Swift_Message('New'))
                        ->setFrom('withthisvision@gmail.com')
                        ->setTo($alo)
                        ->setSubject('[Votre Abonnement expire dans 3 jours]')
                        ->setBody(
                            $this->renderView(
                                'Emails/Avertissement.html.twig'),

                            'text/html'
                        );


                    $mailer->send($message);

                    return $this->render('abonnement/bot.html.twig');





                endif;


            } catch (Exception $exception){

                echo ($exception);
            }


        }





        return $this->render('abonnement/bot.html.twig');

    }



    /**
     * @Route("/chat", name="app_test")
     */
    public function chat(): Response
    {
        return $this->render('chat/index.html.twig');
    }


    /**
     * @Route("/tri", name="tri")
     */
    public function Tri(Request $request,PaginatorInterface $paginator)
    {
        $em = $this->getDoctrine()->getManager();


        $query = $em->createQuery(
            'SELECT a FROM App\Entity\VoyageVirtuel a 
            ORDER BY a.idvv ASC '
        );

        $voyageVirtuel = $query->getResult();

        $voyageVirtuel = $paginator->paginate(
            $voyageVirtuel,
            $request->query->getInt('page',1),
            4
        );

        return $this->render('voyage_virtuels_contoller/index.html.twig',
            array('voyage_virtuels' => $voyageVirtuel));

    }



}
