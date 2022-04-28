<?php

namespace App\Controller;

use App\Entity\ReservationVoiture;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Dompdf;
use Dompdf\Options;
class SalmouchController extends AbstractController
{
    /**
     * @Route("/salmouch", name="app_salmouch")
     */
    public function index(): Response
    {
        return $this->render('salmouch/index.html.twig', [
            'controller_name' => 'SalmouchController',
        ]);
    }

    /**
     * @Route("/salma", name="mailsalima")
     */
    public function bot( \Swift_Mailer $mailer): Response
    { $repository = $this->getDoctrine()->getRepository(ReservationVoiture::class);
        $reservationVoiture = $repository->findAll();
        $em = $this->getDoctrine()->getManager();



                    $message = (new \Swift_Message('New'))
                        ->setFrom('withthisvision@gmail.com')
                        ->setTo('salma.chakhari@esprit.tn')
                        ->setSubject('[Nouvelle reservation voiture cree]')
                        ->setBody(
                            $this->renderView(
                                'Emails/contact.html.twig'),

                            'text/html'
                        );


                    $mailer->send($message);

                    return $this->render('abonnement/bot.html.twig');








    }

    /**
     * @Route("/pdfRV", name="pdfsalima")
     */
    public function Liste(){
        $repository=$this->getDoctrine()->getRepository(ReservationVoiture::class);
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        $reservationVoiture=$repository->findall();


        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('reservation_voitures/listeSalima.html.twig',
            ['reservationVoiture'=>$reservationVoiture]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("Liste_des_reservationsVoitures.pdf", [
            "Attachment" => true
        ]);


    }
}
