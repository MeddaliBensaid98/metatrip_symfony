<?php

namespace App\Controller;

use App\Entity\ReservationHotel;
use App\Form\ReservationHotelType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface; 
use Symfony\Component\Messenger\MessageBusInterface;
use Mediumart\Orange\SMS\SMS;
use Mediumart\Orange\SMS\Http\SMSClient;




/**
 * @Route("/reservationshotels")
 */
class ReservationsHotelsController extends AbstractController
{
    /**
     * @Route("/", name="app_reservations_hotels_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $reservationHotels = $entityManager
            ->getRepository(ReservationHotel::class)
            ->findAll();

        return $this->render('reservations_hotels/index.html.twig', [
            'reservation_hotels' => $reservationHotels,
        ]);
    }

    /**
     * @Route("/new", name="app_reservations_hotels_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager,MailerInterface $mailer,MessageBusInterface $bus): Response
    {
        $user = new User();
        $reservationHotel = new ReservationHotel();
        $reservationHotel->setPrix(60.0);
        $form = $this->createForm(ReservationHotelType ::class, $reservationHotel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($reservationHotel);
            $entityManager->flush();
            
            $mail=$form ['idu']->getData();
            $maill =$mail->getEmail();
            $email=(new Email())
           -> from('gasmi.nayrouz@esprit.tn')
           ->to($maill)
           ->subject('Time for symfony Mailer!')
           ->text('Bonjour notre agence Metatrip veut vous informer que votre reservation numero '.$reservationHotel->getIdrh().' a eté  approuvéé merci de nous contactez pour regler votre paiement');
           $mailer->send ($email);
          
           $client = SMSClient::getInstance('WsxsGp78wGVCUMyuzWhGHMPsM2ZbzaOG', 'pR3ZnujGzrVAc0EC');
           $esms=$form['idu']->getData();

           $sms = new SMS($client);
           $sms->message('Bonjour notre agence Metatrip veut vous informer que votre reservation numero: '. $reservationHotel->getIdrh().' a eté  approuvéé merci de nous contactez pour regler votre paiement'
                                                          )
               ->from('+21655841954')
               ->to("+21629845823")
               ->send();
         
         
           // return $this->redirectToRoute('app_hotels_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reservations_hotels/new.html.twig', [
            'reservation_hotel' => $reservationHotel,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/{idrh}", name="app_reservations_hotels_show", methods={"GET"})
     */
    public function show(ReservationHotel $reservationHotel): Response
    {
        return $this->render('reservations_hotels/show.html.twig', [
            'reservation_hotel' => $reservationHotel,
        ]);
    }

    /**
     * @Route("/{idrh}/edit", name="app_reservations_hotels_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, ReservationHotel $reservationHotel, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ReservationHotel1Type::class, $reservationHotel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_reservations_hotels_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reservations_hotels/edit.html.twig', [
            'reservation_hotel' => $reservationHotel,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idrh}", name="app_reservations_hotels_delete", methods={"POST"})
     */
    public function delete(Request $request, ReservationHotel $reservationHotel, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reservationHotel->getIdrh(), $request->request->get('_token'))) {
            $entityManager->remove($reservationHotel);
            $entityManager->flush();
        }
      
        return $this->redirectToRoute('app_reservations_hotels_index', [], Response::HTTP_SEE_OTHER);
    }
}
