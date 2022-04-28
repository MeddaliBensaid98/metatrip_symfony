<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Entity\Sponsor;
use App\Form\SponsorType;
use App\Repository\SponsorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


// Include Dompdf required namespaces
use Dompdf\Dompdf;
use Dompdf\Options;

use Doctrine\Common\Collections\ArrayCollection;

use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

use Knp\Component\Pager\PaginatorInterface; // Nous appelons le bundle KNP Paginator


/**
 * @Route("/sponsor")
 */
class SponsorController extends AbstractController
{
    /**
     * @Route("/", name="app_sponsor_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager , Request $request  , PaginatorInterface $paginator ): Response
    {
        $donnees = $this->getDoctrine()->getRepository(Sponsor::class)->findAll();

        $sponsors = $paginator->paginate(
            $donnees, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            3 // Nombre de résultats par page
        );

        return $this->render('sponsor/index.html.twig', [
            'sponsors' => $sponsors,
        ]);
    }


    // SAVE EVENTS TO PDF ( SPONSORS )

    /**
     * @Route("/lists", name="lists", methods={"GET"})
     */
    public function lists(EntityManagerInterface $entityManager , Request $request) : Response
    {

        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);

        $sponsors = $entityManager
            ->getRepository(Sponsor::class)
            ->findAll();

        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('sponsor/mypdf.html.twig', [
            'sponsors' => $sponsors
        ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (inline view)
        $dompdf->stream("mypdf.pdf", [
            "Attachment" => false
        ]);



        return new Response('success');

    }



    // TRI SPONSORS Avec NOM

    /**
     * @Route("/tri_sponsorname", name="trie_sponsorname")
     */
    public function orderBySponsornom(EntityManagerInterface $entityManager,SponsorRepository $repository,Request $request,PaginatorInterface $paginator)
    {  $allSponsors = $repository->orderByNomSponsor();
        // Paginate the results of the query
        $appointments = $paginator->paginate(
        // Doctrine Query, not results
            $allSponsors,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            4
        );
        return $this->render('sponsor/index.html.twig', [
            'sponsors' => $appointments,

        ]);
    }



    /**
     * @Route("/new", name="app_sponsor_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $sponsor = new Sponsor();
        $form = $this->createForm(SponsorType::class, $sponsor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($sponsor);
            $entityManager->flush();

            return $this->redirectToRoute('app_sponsor_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('sponsor/new.html.twig', [
            'sponsor' => $sponsor,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{ids}", name="app_sponsor_show", methods={"GET"})
     */
    public function show(Sponsor $sponsor): Response
    {
        return $this->render('sponsor/show.html.twig', [
            'sponsor' => $sponsor,
        ]);
    }

    /**
     * @Route("/{ids}/edit", name="app_sponsor_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Sponsor $sponsor, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SponsorType::class, $sponsor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_sponsor_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('sponsor/edit.html.twig', [
            'sponsor' => $sponsor,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{ids}", name="app_sponsor_delete", methods={"POST"})
     */
    public function delete(Request $request, Sponsor $sponsor, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sponsor->getIds(), $request->request->get('_token'))) {
            $entityManager->remove($sponsor);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_sponsor_index', [], Response::HTTP_SEE_OTHER);
    }





}
