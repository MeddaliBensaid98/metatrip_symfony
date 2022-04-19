<?php

namespace App\Controller;

// Entities
use App\Entity\Evenement;
use App\Entity\Sponsor;
use App\Entity\PropertySearch;
use App\Entity\PriceSearch;

// Bundles
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

// Forms
use App\Form\PropertySearchType;
use App\Form\PriceSearchType;

// Repo
use App\Repository\EvenementRepository;

use Dompdf\Dompdf;
use Dompdf\Options;

class DefaultController extends AbstractController
{
    /**
     * @Route("/index", name="index")
     */
    public function index(): Response
    {
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    /**
     * @Route("/indexFront", name="indexFront")
     */
    public function indexFront(): Response
    {
        return $this->render('default/index.front.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    /**
     * @Route("/Myevents", name="Myevents")
     */
    public function Myevents(EntityManagerInterface $entityManager , Request $request): Response
    {

        //  Affichage par defaut

        $evenements = $entityManager
            ->getRepository(Evenement::class)
            ->findAll();

        $propertySearch = new PropertySearch();
        $form = $this->createForm(PropertySearchType::class,$propertySearch);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            // Search By Chanteur
            $chanteur = $propertySearch->getChanteur();
            if ($chanteur!="")
                // si ce nom est existe
                $evenements= $this->getDoctrine()->getRepository(Evenement::class)->findBy(['chanteur' => $chanteur] );

            else
                // si n'existe pas
                $evenements= $this->getDoctrine()->getRepository(Evenement::class)->findAll();


        }


      return $this->render('default/events.html.twig', [
            'form' => $form->createView(),
            'evenements' => $evenements

      ]  ) ;

    }



    /**
     * @Route("/sponsors", name="sponsors")
     */
    public function sponsors(EntityManagerInterface $entityManager): Response
    {
        $sponsors = $entityManager
            ->getRepository(Sponsor::class)
            ->findAll();

        return $this->render('default/sponsors.html.twig', [
            'sponsors' => $sponsors,
        ]);
    }



    // SAVE EVENTS TO PDF

    /**
     * @Route("/listp", name="listp", methods={"GET"})
     */
    public function listp(EntityManagerInterface $entityManager , Request $request) : Response
    {

        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);

        $evenements = $entityManager
            ->getRepository(Evenement::class)
            ->findAll();

        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('evenement/mypdf.html.twig', [
            'evenements' => $evenements
        ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);
        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');
        // Render the HTML as PDF
        $dompdf->render();
        // Output the generated PDF to Browser (force download)
        $dompdf->stream("MyEventsList.pdf", [
            "Attachment" => true
        ]);

        return new Response('success');

    }

}






