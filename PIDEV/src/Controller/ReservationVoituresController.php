<?php

namespace App\Controller;

use App\Entity\ReservationVoiture;
use App\Form\ReservationVoiture1Type;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/reservationvoitures")
 */
class ReservationVoituresController extends AbstractController
{
    /**
     * @Route("/", name="app_reservation_voitures_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $reservationVoitures = $entityManager
            ->getRepository(ReservationVoiture::class)
            ->findAll();

        return $this->render('reservation_voitures/index.html.twig', [
            'reservation_voitures' => $reservationVoitures,
        ]);
    }

    /**
     * @Route("/new", name="app_reservation_voitures_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager,\Swift_Mailer $mailer): Response
    {
        $reservationVoiture = new ReservationVoiture();
        $form = $this->createForm(ReservationVoiture1Type::class, $reservationVoiture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($reservationVoiture);
            $entityManager->flush();


            $message = (new \Swift_Message('New'))
                ->setFrom('withthisvision@gmail.com')
                ->setTo('salma.chakhari@esprit.tn')
                ->setSubject('[Nouvelle reservation voiture]')
                ->setBody(
                    $this->renderView(
                        'Emails/contact.html.twig'),

                    'text/html'
                );


            $mailer->send($message);


            return $this->redirectToRoute('app_reservation_voitures_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reservation_voitures/new.html.twig', [
            'reservation_voiture' => $reservationVoiture,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idrvoit}", name="app_reservation_voitures_show", methods={"GET"})
     */
    public function show(ReservationVoiture $reservationVoiture): Response
    {
        return $this->render('reservation_voitures/show.html.twig', [
            'reservation_voiture' => $reservationVoiture,
        ]);
    }

    /**
     * @Route("/{idrvoit}/edit", name="app_reservation_voitures_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, ReservationVoiture $reservationVoiture, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ReservationVoiture1Type::class, $reservationVoiture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_reservation_voitures_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reservation_voitures/edit.html.twig', [
            'reservation_voiture' => $reservationVoiture,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idrvoit}", name="app_reservation_voitures_delete", methods={"POST"})
     */
    public function delete(Request $request, ReservationVoiture $reservationVoiture, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reservationVoiture->getIdrvoit(), $request->request->get('_token'))) {
            $entityManager->remove($reservationVoiture);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_reservation_voitures_index', [], Response::HTTP_SEE_OTHER);
    }
}
