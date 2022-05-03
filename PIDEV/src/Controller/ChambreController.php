<?php

namespace App\Controller;

use App\Entity\Chambre;
use App\Form\Chambre1Type;
use App\Form\ChambreType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use Flasher\Toastr\Prime\ToastrFactory;


/**
 * @Route("/chambre")
 */
class ChambreController extends AbstractController
{
    /**
     * @Route("/", name="app_chambre_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $chambres = $entityManager
            ->getRepository(Chambre::class)
            ->findAll();

        return $this->render('chambre/index.html.twig', [
            'chambres' => $chambres,
        ]);
    }
     /**
     * @Route("/chartjs", name="chartjs"), methods={"GET"}
     */
    public function statistiques(EntityManagerInterface $entityManager): Response

    {
        $resch = $entityManager
            ->getRepository(Chambre::class)
            ->findAll();



      
        $ic=0;
        $icc=0;
        $es=0;
        // On "démonte" les données pour les séparer tel qu'attendu par ChartJS
        foreach ($resch as $ch)
        {
            if (  $ch->getEtat()=="Disponible")  :

                $ic+=1;
            elseif ( $ch->getEtat()=="Non Disponible"):

                $icc+=1;

            endif;

        }

       
        $pieChart = new PieChart();
        $pieChart->getData()->setArrayToDataTable(
            [['type', 'type'],
                ['Disponible',     $ic],
                ['Non Disponible',      $icc]
            ]);
        $pieChart->getOptions()->setColors(['#4682B4', '#4169E1']);

        $pieChart->getOptions()->setHeight(500);
        $pieChart->getOptions()->setWidth(900);
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#009900');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);

        return $this->render('chambre/chartjs.html.twig',array('piechart' => $pieChart));
    }

    /**
     * @Route("/new", name="app_chambre_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager, ToastrFactory $flasher): Response
    {
        $chambre = new Chambre();
        $form = $this->createForm(Chambre1Type::class, $chambre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $image = $form->get('image')->getData();
            $imageName = md5(uniqid()).'.'.$image->guessExtension();
            $image->move($this->getParameter('brochures_directory'), $imageName);
            $chambre->setImage($imageName);
            $flasher->addSuccess('Data has been saved successfully!');
            $entityManager->persist($chambre);
            $entityManager->flush();
            
            return $this->redirectToRoute('app_chambre_index', [], Response::HTTP_SEE_OTHER);
           
         
        }

        return $this->render('chambre/new.html.twig', [
            'chambre' => $chambre,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idc}", name="app_chambre_show", methods={"GET"})
     */
    public function show(Chambre $chambre): Response
    {
        return $this->render('chambre/show.html.twig', [
            'chambre' => $chambre,
        ]);
    }

    /**
     * @Route("/{idc}/edit", name="app_chambre_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Chambre $chambre, EntityManagerInterface $entityManager,ToastrFactory $flasher): Response
    {
        $form = $this->createForm(ChambreType::class, $chambre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $image = $form->get('image')->getData();
            $imageName = md5(uniqid()).'.'.$image->guessExtension();
            $image->move($this->getParameter('brochures_directory'), $imageName);
            $chambre->setImage($imageName);
            

            $entityManager->flush();
           

            return $this->redirectToRoute('app_chambre_index', [], Response::HTTP_SEE_OTHER);
            $flasher->addSuccess('Data has been updated successfully!');
        }

        return $this->render('chambre/edit.html.twig', [
            'chambre' => $chambre,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idc}", name="app_chambre_delete", methods={"POST"})
     */
    public function delete(Request $request, Chambre $chambre, EntityManagerInterface $entityManager,ToastrFactory $flasher): Response
    {
        if ($this->isCsrfTokenValid('delete'.$chambre->getIdc(), $request->request->get('_token'))) {
            $entityManager->remove($chambre);
            $entityManager->flush();
        }
        $flasher->addSuccess('Data has been removed successfully!');


        return $this->redirectToRoute('app_chambre_index', [], Response::HTTP_SEE_OTHER);
    }
}
