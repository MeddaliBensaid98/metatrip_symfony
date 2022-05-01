<?php

namespace App\Controller;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\Label\Alignment\LabelAlignmentCenter;
use Endroid\QrCode\Label\Font\NotoSans;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Writer\SvgWriter;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;
 
 
 
use Endroid\QrCode\Label\Margin\Margin;
 
use Endroid\QrCode\Builder\BuilderInterface;
 
 
use App\Repository\ReservationVoyageRepository;
 use Symfony\Component\HttpFoundation\Session\Session;
 


use Dompdf\Options;
use App\Entity\ReservationVoyage;
use App\Form\ReservationVoyage1Type;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Dompdf\Dompdf;

 
/**
 * @Route("/reservation_voyage")
 */
class ReservationVoyageController extends AbstractController
{
    /**
     * @Route("/", name="app_reservation_voyage_index", methods={"GET"})
     */
    public function index(Session $session,EntityManagerInterface $entityManager): Response
    {
        $reservationVoyages = $entityManager
            ->getRepository(ReservationVoyage::class)
            ->findAll();
            if( $session->get('login')=="true"){
        return $this->render('reservation_voyage/index.html.twig', [
            'reservation_voyages' => $reservationVoyages,
        ]);
    }else{
        return $this->redirectToRoute('security_login');
    } 
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
        $png = file_get_contents("metatrip.png");
        $pngbase64 = base64_encode($png);
        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('reservation_voyage/index1.html.twig', [
            'reservation_voyages' => $reservationVoyages,"img64"=>$pngbase64
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


    
    /**
        * @Route("/{idrv}/accept", name="app_reservation_voyage_accept", methods={"GET", "POST"})
        */   public function acceptRV(\Swift_Mailer $mailer, Request $request, ReservationVoyage $reservationVoyage, EntityManagerInterface $entityManager): Response
        {
            $reservationVoyage->setEtat('PAYE');
            $entityManager->flush();
            
            $idr=$reservationVoyage->getIdrv();
            $emailuser=$reservationVoyage->getIdu()->getEmail();
            $cin=$reservationVoyage->getIdu()->getCin();
            $nom=$reservationVoyage->getIdu()->getNom();
            $prenom=$reservationVoyage->getIdu()->getPrenom();
           
         
     
            
             $msgQRCode=$nom.'  '.$prenom.'CIN ='.$cin.'  Reservation Voyage '.$idr.' est acceptée';
     
            $objDateTime = new \DateTime('NOW');
            $dateString = $objDateTime->format('d-m-Y H:i:s');
     
            $path = dirname(__DIR__, 2).'/public/assets/';
            
            // set qrcode
            $result = Builder::create()
                ->data($msgQRCode)
                ->encoding(new Encoding('UTF-8'))
                ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
                ->size(400)
                ->margin(10)
                ->labelText($dateString)
                ->labelAlignment(new LabelAlignmentCenter())
                ->labelMargin(new Margin(15, 5, 5, 5))
                ->logoPath($path.'img/logo.png')
                ->logoResizeToWidth('100')
                ->logoResizeToHeight('100')
                ->backgroundColor(new Color(221, 158, 3))
                ->build()
            ;
     
     
     
            //generate name
            $namePng ='flaaam.png';
     
            //Save img png
            $result->saveToFile($path.'img/'.$namePng);
     
     
            
     
     
            $message = (new \Swift_Message('Réservation voyage METATRIP'))
            ->setFrom('solidev.3a18@gmail.com')
            ->setTo($emailuser)
            ->setBody(' <center> 
            <h2>bienvenue sur notre site  Metatrip</h2> <br><h4>une fois metatrip!toujour metatrip 
            </h4></center></br></center><center><h3>Cher client  '.$nom.'     '.$prenom.' nous voulons vous informer que votre reservation de voyage a été acceptée </h3></center><br>
            <center>et votre pass est le joint ci dessous </center><br>   </br>', 'text/html') ;
            $message->embed(\Swift_Image::fromPath('assets/img/flaaam.png'));
            $mailer->send($message);
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
             $reservationVoyages = $entityManager
             ->getRepository(ReservationVoyage::class)
             ->findAll();
     
         return $this->render('reservation_voyage/index.html.twig', [
             'reservation_voyages' => $reservationVoyages,
         ]);
         }
     
}