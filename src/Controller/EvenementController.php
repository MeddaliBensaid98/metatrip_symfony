<?php

namespace App\Controller;

// Entities
use Adamski\Symfony\NotificationBundle\NotificationBundle;
use App\Entity\Evenement;
use App\Entity\PropertySearch;
use App\Form\PropertySearchType;
use App\Entity \ReservationEvent;
use App\Entity\Sponsor;


// Form

use App\Form\EvenementType;



use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// Repository
use App\Repository\EvenementRepository ;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

// Include Dompdf required namespaces
use Dompdf\Dompdf;
use Dompdf\Options;


use Doctrine\Common\Collections\ArrayCollection;

use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

use Knp\Component\Pager\PaginatorInterface; // Nous appelons le bundle KNP Paginator




/**
 * @Route("/evenement")
 */
class EvenementController extends AbstractController
{
    /**
     * @Route("/", name="app_evenement_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager , Request $request , PaginatorInterface $paginator ): Response
    {

        $donnees = $this->getDoctrine()->getRepository(Evenement::class)->findAll();

        $evenements = $paginator->paginate(
            $donnees, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
           3 // Nombre de résultats par page
        );

        return $this->render('evenement/index.html.twig', [
            'evenements' => $evenements,
        ]);


    }





    // TRI EVENTS Avec CHANTEUR

    /**
     * @Route("/tri_chanteur", name="trie_chanteur")
     */
    public function orderByChanteur(EntityManagerInterface $entityManager,EvenementRepository $repository,Request $request,PaginatorInterface $paginator)
    {  $allChanteur = $repository->orderByChanteur();
        // Paginate the results of the query
        $appointments = $paginator->paginate(
        // Doctrine Query, not results
            $allChanteur,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            4
        );
        return $this->render('evenement/index.html.twig', [
            'evenements' => $appointments,

        ]);
    }


    public function nbreplace () {

    }


    // TRI EVENTS Avec PRIX

    /**
     * @Route("/tri_prix", name="trie_prix")
     */
    public function orderByPrice(EntityManagerInterface $entityManager,EvenementRepository $repository,Request $request,PaginatorInterface $paginator)
    {  $allprix = $repository->orderByPrix();
        // Paginate the results of the query
        $appointments = $paginator->paginate(
        // Doctrine Query, not results
            $allprix,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            4
        );
        return $this->render('evenement/index.html.twig', [
            'evenements' => $appointments,

        ]);
    }


    // TRI EVENTS Avec Chanteur ASC PRIX DESC



    /**
     * @Route("/multi", name="multis", methods={"GET"})
     */
    public function multi(EntityManagerInterface $entityManager): Response
    {
        $reservationEvents = $entityManager
            ->getRepository(ReservationEvent::class)
            ->findAll();

        return $this->render('reservation_event/index.html.twig', [
            'reservation_events' => $reservationEvents,
        ]);
    }







    public function listingEventAction(){

        $em = $this->getDoctrine()->getManager();

        $events = $em->getRepository(EvenementRepository::class)->listEvents();

        foreach($events as $event){

            $event[] =[
                'id'=> $event->getIde(),
                'title' => $event->getChanteur(),
                'start' => $event->getDateEvent(),
                'end' => $event->getDateend(),
                'description' => $event->getTypeEvent()
            ]
            ;
        }

        $data = json_encode($rdv);

        return $this->render('evenement/calendar.html.twig', compact('data'));


    }






    /**

     * @Route("/drop", name="evenement_drop", methods={"GET","POST"})
     */

    /*
    public function update_tache(EntityManagerInterface $entityManager , EvenementRepository  $repo , Request $request, ObjectManager $manager)
    {
        $evenements = new Evenement();
        $start = new DateTime($request->query->get('start'));
        $end = new DateTime($request->query->get('end'));

        $evenements = $entityManager
            ->getRepository(Evenement::class)
            ->findAll();

        $evenements = $repo->find($request->query->get('id'));

        $evenements ->setDateEvent($start);
        $evenements ->setDateend($end);


        $form = $this->createForm(EvenementType::class, $evenements ) ;


        if ($evenements) {
            $form->handleRequest($request);

            $evenements = $form->getData();
            $manager->persist($evenements);
            $manager->flush();
        }

        return $this->json([
            'evenements' => $evenements
        ]);



    } */


        // CALENDAR

    /**
     * @Route("/calendar", name="calendar")
     */
    public function fullCalendar(EvenementRepository  $calendar)
    {
        $events = $calendar->findAll();

        $rdv = [];

        foreach($events as $event){
            $rdv[] = [
                'id' => $event->getIde(),
                'start' => $event->getDateEvent()->format('Y-m-d H:i:s'),
                'end' => $event->getDateend(),
                'title' => $event->getChanteur(),
                'description'=> $event->getAdresse(),


            ];
        }

        $data = json_encode($rdv);

        return $this->render('evenement/calendar.html.twig', compact('data'));
    }





        // SAVE EVENTS TO PDF ( EVENTS)

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
            "Attachment" => false
        ]);

        return new Response('success');

    }



    /**
     * @Route("/user/event", name="eventlist", methods={"GET"})
     */
    public function evenementlist(EntityManagerInterface $entityManager,EvenementRepository $repo): Response
    {
        $events = $repo->findListaevenements();


        return $this->render('evenement/listev.html.twig', [
            'events' => $events,
        ]);
    }





    /**
     * @Route("/new", name="app_evenement_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $evenement = new Evenement();
        $form = $this->createForm(EvenementType::class, $evenement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($evenement);
            $entityManager->flush();


            return $this->redirectToRoute('app_evenement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('evenement/new.html.twig', [
            'evenement' => $evenement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{ide}", name="app_evenement_show", methods={"GET"})
     */
    public function show(Evenement $evenement): Response
    {
        return $this->render('evenement/show.html.twig', [
            'evenement' => $evenement,
        ]);
    }

    /**
     * @Route("/{ide}/edit", name="app_evenement_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Evenement $evenement, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EvenementType::class, $evenement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_evenement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('evenement/edit.html.twig', [
            'evenement' => $evenement,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/{ide}", name="app_evenement_delete", methods={"POST"})
     */
    public function delete(Request $request, Evenement $evenement, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$evenement->getIde(), $request->request->get('_token'))) {
            $entityManager->remove($evenement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_evenement_index', [], Response::HTTP_SEE_OTHER);
    }



}
