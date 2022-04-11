<?php

namespace App\Controller;

use App\Entity\VoyageOrganise;
use App\Repository\VoyageOrganiseRepository;
use App\Form\VoyageOrganiseType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/voyage/organise")
 */
class VoyageOrganiseController extends AbstractController
{
    /**
     * @Route("/list", name="app_voyage_organise_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $voyageOrganises = $entityManager
            ->getRepository(VoyageOrganise::class)
            ->findAll();

        return $this->render('voyage_organise/index.html.twig', [
            'voyage_organises' => $voyageOrganises,
        ]);
    }



  /**
     * @Route("/test", name="indexTest", methods={"GET"})
     */

    public function listStudentByDate(VoyageOrganiseRepository $repo):Response
    {

        $voyageOrganises = $repo->findListaVoyages();
        
      //$l=sizeof($voyageOrganises);
        //echo "alert('$l');";
      
        return $this->render('user/listvoy.html.twig', [
            'voyageOrganises' => $voyageOrganises,
        ]);
    }



    /**
     * @Route("/new", name="app_voyage_organise_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $voyageOrganise = new VoyageOrganise();
        $form = $this->createForm(VoyageOrganiseType::class, $voyageOrganise);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($voyageOrganise);
            $entityManager->flush();

            return $this->redirectToRoute('app_voyage_organise_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('voyage_organise/new.html.twig', [
            'voyage_organise' => $voyageOrganise,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idvo}", name="app_voyage_organise_show", methods={"GET"})
     */
    public function show(VoyageOrganise $voyageOrganise): Response
    {
        return $this->render('voyage_organise/show.html.twig', [
            'voyage_organise' => $voyageOrganise,
        ]);
    }

    /**
     * @Route("/{idvo}/edit", name="app_voyage_organise_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, VoyageOrganise $voyageOrganise, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(VoyageOrganiseType::class, $voyageOrganise);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_voyage_organise_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('voyage_organise/edit.html.twig', [
            'voyage_organise' => $voyageOrganise,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idvo}", name="app_voyage_organise_delete", methods={"POST"})
     */
    public function delete(Request $request, VoyageOrganise $voyageOrganise, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$voyageOrganise->getIdvo(), $request->request->get('_token'))) {
            $entityManager->remove($voyageOrganise);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_voyage_organise_index', [], Response::HTTP_SEE_OTHER);
    }
}
