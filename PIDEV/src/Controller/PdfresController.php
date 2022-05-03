<?php

namespace App\Controller;

use App\Entity\ReservationHotel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Dompdf;
use Dompdf\Options;

class PdfresController extends AbstractController
{
    /**
     * @Route("/pdfres", name="app_pdfres")
     */
    public function index(): Response
    {
        return $this->render('pdfres/index.html.twig', [
            'controller_name' => 'PdfresController',
        ]);
    }
    /**
     * @Route("/pdfRVv", name="pdfres")
     */
    public function Liste(){
        $repository=$this->getDoctrine()->getRepository(ReservationHotel::class);
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        $ReservationHotel =new ReservationHotel();
        
       

        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('pdfres/index.html.twig',
            ['reservation_hotels'=>$ReservationHotel,]);
            
      

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
