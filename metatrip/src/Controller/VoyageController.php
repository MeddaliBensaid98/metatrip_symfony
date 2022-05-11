<?php

namespace App\Controller;

use App\Entity\Voyage;
use App\Form\Voyage1Type;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Repository\VoyageRepository;

/**
 * @Route("/voyage")
 */
class VoyageController extends AbstractController
{



/**
 * @Route("/json/delll/{idv}", name="deldvoy", methods={"GET"})
 */
public function removeVoy($idv, Request $request,EntityManagerInterface $entityManager,VoyageRepository $repo): JsonResponse
{
    $voyage =$repo->findOneBy(['idv' => $idv]);
 

    if ($voyage==null )
    {   return new JsonResponse(['status' => 'ID voyage incorrect !'], Response::HTTP_NOT_FOUND); }
 
     $entityManager->remove($voyage);   
     $entityManager->flush();

    return new JsonResponse(['status' => 'voyage suprrimé avec succès !'], Response::HTTP_CREATED);}






  /**
     * @Route("/json", name="app_voyage_json", methods={"GET"})
     */
    public function AffichageJson(EntityManagerInterface $entityManager,VoyageRepository $repo)
    { 
     
        
        $voyages = $repo->findAll();

        $data =  $this->get('serializer')->serialize($voyages, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
     }
      




 /**
     * @Route("/new/json/{p}/{Image_pays}", name="addVoyJson", methods={"GET"})
     */
    public function addVoy($p,$Image_pays,Request $request,EntityManagerInterface $entityManager): JsonResponse
    {
        $voyage = new Voyage();
        $data = json_decode($request->getContent(), true);

        $pays = $p;
        $imagePays = $Image_pays;
      

      




        if (empty($imagePays) || empty($pays) )
         {   return new JsonResponse(['status' => 'manque des attributs !'], Response::HTTP_NOT_FOUND); }
        $voyage->setPays($pays);

        $voyage->setImagePays($imagePays);
       
        $entityManager->persist($voyage);
        $entityManager->flush();

        return new JsonResponse(['status' => 'voyage crée avec succès !'], Response::HTTP_CREATED);
    }




/**
 * @Route("/json/{idv}/{p}/{Image_pays}", name="updatevoy", methods={"GET"})
 */
public function updateVoy($idv,$p,$Image_pays, Request $request,EntityManagerInterface $entityManager,VoyageRepository $repo): JsonResponse
{
    $voyage =$repo->findOneBy(['idv' => $idv]);
    $data = json_decode($request->getContent(), true);

    $data['pays'] = $p;
    $data['imagePays'] = $Image_pays;
    if (empty($data['imagePays']) || empty($data['pays']) )
    {   return new JsonResponse(['status' => 'manque des attributs !'], Response::HTTP_NOT_FOUND); }
    empty($data['imagePays']) ? true : $voyage->setImagePays($data['imagePays']);
    empty($data['pays']) ? true : $voyage->setPays($data['pays']);


 
     $entityManager->flush();

    return new JsonResponse(['status' => 'voyage modifié avec succès !'], Response::HTTP_CREATED);}






/**
 * @Route("/json/{idv}", name="getvoy", methods={"GET"})
 */
public function getVoy($idv, Request $request,EntityManagerInterface $entityManager,VoyageRepository $repo): JsonResponse
{
    $voyage =$repo->findOneBy(['idv' => $idv]);
 

    if ($voyage==null )
    {   return new JsonResponse(['status' => 'ID voyage incorrect !'], Response::HTTP_NOT_FOUND); }
 

    $data = [
        'idv' => $voyage->getIdv(),
        'pays' => $voyage->getPays(),
        'imagePays' => $voyage->getImagePays(),
     
    ];
 
    return new JsonResponse($voyage->toArray, Response::HTTP_OK);}







    /**
     * @Route("/", name="app_voyage_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $voyages = $entityManager
            ->getRepository(Voyage::class)
            ->findAll();

        return $this->render('voyage/index.html.twig', [
            'voyages' => $voyages,
        ]);
    }

    /**
     * @Route("/new", name="app_voyage_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $voyage = new Voyage();
        $form = $this->createForm(Voyage1Type::class, $voyage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($voyage);
            $entityManager->flush();

            return $this->redirectToRoute('app_voyage_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('voyage/new.html.twig', [
            'voyage' => $voyage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idv}", name="app_voyage_show", methods={"GET"})
     */
    public function show(Voyage $voyage): Response
    {
        return $this->render('voyage/show.html.twig', [
            'voyage' => $voyage,
        ]);
    }

    /**
     * @Route("/{idv}/edit", name="app_voyage_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Voyage $voyage, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Voyage1Type::class, $voyage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_voyage_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('voyage/edit.html.twig', [
            'voyage' => $voyage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idv}", name="app_voyage_delete", methods={"POST"})
     */
    public function delete(Request $request, Voyage $voyage, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$voyage->getIdv(), $request->request->get('_token'))) {
            $entityManager->remove($voyage);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_voyage_index', [], Response::HTTP_SEE_OTHER);
    }
}
