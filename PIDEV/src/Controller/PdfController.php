<?php

namespace App\Controller;

use App\Entity\ReservationHotel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Dompdf;
use Dompdf\Options;


class PdfController extends AbstractController
{
    /**
     * @Route("/pdf", name="app_pdf")
     */
    public function index(): Response
    {
        return $this->render('pdf/index.html.twig', [
            'controller_name' => 'PdfController',
        ]);
    }







    
 

    /**
     * @Route("/pdfRV", name="pdfreservation")
     */
    public function Liste(){
        $repository=$this->getDoctrine()->getRepository(ReservationHotel::class);
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        $reservation_hotels=$repository->findall();
       

        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('pdf/index.html.twig',
            ['reservation_hotels'=>$reservation_hotels,]);
            
      

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("Liste_des_reservationshotels.pdf", [
            "Attachment" => true
        ]);


    }
}

