<?php

namespace App\Controller;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Entity\ReservationVoyage;
use App\Form\ReservationVoyage1Type;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\ReservationVoyageRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/reservation_voyage")
 */
class ReservationVoyageController extends AbstractController
{
    /**
     * @Route("/", name="app_reservation_voyage_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $reservationVoyages = $entityManager
            ->getRepository(ReservationVoyage::class)
            ->findAll();

        return $this->render('reservation_voyage/index.html.twig', [
            'reservation_voyages' => $reservationVoyages,
        ]);
    }

    /**
     * @Route("/new", name="app_reservation_voyage_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $reservationVoyage = new ReservationVoyage();
        $form = $this->createForm(ReservationVoyage1Type::class, $reservationVoyage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($reservationVoyage);
            $entityManager->flush();

            return $this->redirectToRoute('app_reservation_voyage_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reservation_voyage/new.html.twig', [
            'reservation_voyage' => $reservationVoyage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idrv}", name="app_reservation_voyage_show", methods={"GET"})
     */
    public function show(ReservationVoyage $reservationVoyage): Response
    {
        return $this->render('reservation_voyage/show.html.twig', [
            'reservation_voyage' => $reservationVoyage,
        ]);
    }

    /**
     * @Route("/{idrv}/edit", name="app_reservation_voyage_edit", methods={"GET", "POST"})
     */   public function edit(Request $request, ReservationVoyage $reservationVoyage, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ReservationVoyage1Type::class, $reservationVoyage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $dateArivee=$reservationVoyage->getDateArrivee()->format("Y-m-d");
            $dateDebut=$reservationVoyage->getDateDepart()->format("Y-m-d");
            $timestamp1 = strtotime($dateArivee); 
            $timestamp2 = strtotime($dateDebut); 
            
          if($timestamp2 <$timestamp1){

          
          
   $entityManager->flush();

            return $this->redirectToRoute('app_reservation_voyage_index', [], Response::HTTP_SEE_OTHER);
        }else {
            echo ("<script > alert('Date de depar>date d'arrivée')</script>");
        }
         


        }

        return $this->render('reservation_voyage/edit.html.twig', [
            'reservation_voyage' => $reservationVoyage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idrv}", name="app_reservation_voyage_delete", methods={"POST"})
     */
    public function delete(Request $request, ReservationVoyage $reservationVoyage, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reservationVoyage->getIdrv(), $request->request->get('_token'))) {
            $entityManager->remove($reservationVoyage);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_reservation_voyage_index', [], Response::HTTP_SEE_OTHER);
    }

   
    
    /**
     * @Route("/imrpimer/imrpimer/voyage", name="imprimerRev", methods={"GET"})
     */
    public function indexImrpimer(EntityManagerInterface $entityManager)
    {
        $reservationVoyages = $entityManager
            ->getRepository(ReservationVoyage::class)
            ->findAll();
          
        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        
        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        
        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('reservation_voyage/index1.html.twig', [
            'reservation_voyages' => $reservationVoyages,
        ]);
        
        // Load HTML to Dompdf
        $dompdf->loadHtml($html);
        
        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("mypdf2.pdf", [
            "Attachment" => true
        ]);
              
        return $this->render('reservation_voyage/index.html.twig', [
            'reservation_voyages' => $reservationVoyages,
        ]);
    }

   

/**
     * @Route("/tripardatedepart/depart", name="tripardatedepart")
    */
    public function orderBydateDepar(EntityManagerInterface $entityManager,ReservationVoyageRepository $repository,Request $request)
    {  $allDate = $repository->orderByDateDepart();
       // Paginate the results of the query
   return $this->render('reservation_voyage/index.html.twig', [
            'reservation_voyages' => $allDate,
        
        ]);
    }  
   
    /**
     * @Route("/tripardatearrivee/arrive/arrive", name="tripardatearrivee")
    */
    public function orderBydateArrivee(EntityManagerInterface $entityManager,ReservationVoyageRepository $repository,Request $request)
    {  $allDate = $repository->orderBydateArrivee();
       // Paginate the results of the query
   return $this->render('reservation_voyage/index.html.twig', [
            'reservation_voyages' => $allDate,
        
        ]);
    } 
 
       /**
     * @Route("/triparetat/etat", name="triparetat")
    */
    public function orderByetat(EntityManagerInterface $entityManager,ReservationVoyageRepository $repository,Request $request)
    {  $allDate = $repository->orderByetat();
       // Paginate the results of the query
   return $this->render('reservation_voyage/index.html.twig', [
            'reservation_voyages' => $allDate,
        
        ]);
    } 


      /**
     * @Route("/triparrefpaiment/ref", name="triparrefpaiment")
    */
    public function orderByRefpaiment(EntityManagerInterface $entityManager,ReservationVoyageRepository $repository,Request $request)
    {  $allDate = $repository->orderByRefpaiment();
       // Paginate the results of the query
   return $this->render('reservation_voyage/index.html.twig', [
            'reservation_voyages' => $allDate]);
    } 
 
}
