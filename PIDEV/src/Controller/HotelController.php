<?php

namespace App\Controller;

use App\Entity\Hotel;
use App\Form\Hotel1Type;
use App\Form\Hotel2Type;
use App\Form\HotelType;
use App\Repository\HotelRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Flasher\Toastr\Prime\ToastrFactory;

/**
 * @Route("/hotel")
 */
class HotelController extends AbstractController
{
    /**
     * @Route("/", name="app_hotel_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $hotels = $entityManager
            ->getRepository(Hotel::class)
            ->findAll();

        return $this->render('hotel/index.html.twig', [
            'hotels' => $hotels,
        ]);
    }

   


 

    /**
     * @Route("/new", name="app_hotel_new", methods={"GET", "POST"})
     */
    public function new(  Request $request, EntityManagerInterface $entityManager ,ToastrFactory $flasher ): Response
    {
        $hotel = new Hotel();
        $form = $this->createForm(Hotel2Type::class, $hotel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $image = $form->get('image')->getData();
            $imageName = md5(uniqid()).'.'.$image->guessExtension();
            $image->move($this->getParameter('brochures_directory'), $imageName);
            $hotel->setImage($imageName);
           
            $entityManager->persist($hotel);
            $entityManager->flush();

            return $this->redirectToRoute('app_hotel_index', [], Response::HTTP_SEE_OTHER);
           
            $flasher->addSuccess('Data has been saved successfully!');
           

          
        }

        return $this->render('hotel/new.html.twig', [
            'hotel' => $hotel,
            'form' => $form->createView(),
          
        ]);
        
    }

    /**
     * @Route("/{idh}", name="app_hotel_show", methods={"GET"})
     */
    public function show(Hotel $hotel): Response
    {
        return $this->render('hotel/show.html.twig', [
            'hotel' => $hotel,
        ]);
    }

    /**
     * @Route("/{idh}/edit", name="app_hotel_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Hotel $hotel, EntityManagerInterface $entityManager,ToastrFactory $flasher): Response
    {
        $form = $this->createForm(HotelType::class, $hotel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            
           
            return $this->redirectToRoute('app_hotel_index', [], Response::HTTP_SEE_OTHER);
            $flasher->addSuccess('Data has been updated successfully!');
          
        }

        return $this->render('hotel/edit.html.twig', [
            'hotel' => $hotel,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idh}", name="app_hotel_delete", methods={"POST"})
     */
    public function delete( Request $request, Hotel $hotel, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$hotel->getIdh(), $request->request->get('_token'))) {
            $entityManager->remove($hotel);
            $entityManager->flush();
        }
     

        return $this->redirectToRoute('app_hotel_index', [], Response::HTTP_SEE_OTHER);
    }

   
}