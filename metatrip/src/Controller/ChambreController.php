<?php

namespace App\Controller;

use App\Entity\Chambre;
use App\Form\Chambre1Type;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/chambre")
 */
class ChambreController extends AbstractController
{
    /**
     * @Route("/", name="app_chambre_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $chambres = $entityManager
            ->getRepository(Chambre::class)
            ->findAll();

        return $this->render('chambre/index.html.twig', [
            'chambres' => $chambres,
        ]);
    }

    /**
     * @Route("/new", name="app_chambre_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $chambre = new Chambre();
        $form = $this->createForm(Chambre1Type::class, $chambre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($chambre);
            $entityManager->flush();

            return $this->redirectToRoute('app_chambre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('chambre/new.html.twig', [
            'chambre' => $chambre,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idc}", name="app_chambre_show", methods={"GET"})
     */
    public function show(Chambre $chambre): Response
    {
        return $this->render('chambre/show.html.twig', [
            'chambre' => $chambre,
        ]);
    }

    /**
     * @Route("/{idc}/edit", name="app_chambre_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Chambre $chambre, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Chambre1Type::class, $chambre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_chambre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('chambre/edit.html.twig', [
            'chambre' => $chambre,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idc}", name="app_chambre_delete", methods={"POST"})
     */
    public function delete(Request $request, Chambre $chambre, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$chambre->getIdc(), $request->request->get('_token'))) {
            $entityManager->remove($chambre);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_chambre_index', [], Response::HTTP_SEE_OTHER);
    }
}
