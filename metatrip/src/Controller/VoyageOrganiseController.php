<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Voyage;
use App\Form\RsrvType;
use App\Entity\VoyageOrganise;

use App\Form\VoyageOrganiseType;
use App\Entity\ReservationVoyage;
use App\Repository\UserRepository;

use Doctrine\ORM\EntityManagerInterface;
use App\Repository\VoyageOrganiseRepository;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\EventDispatcher\GenericEvent;

use Symfony\Component\HttpFoundation\Session\Session;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @Route("/voyage_organise")
 */
class VoyageOrganiseController extends AbstractController
{
    /**
     * @Route("/", name="app_voyage_organise_index", methods={"GET"})
     */
    public function index(Session  $session,EntityManagerInterface $entityManager): Response
    {
        $voyageOrganises = $entityManager
            ->getRepository(VoyageOrganise::class)
            ->findAll();
            if( $session->get('login')=="true"){
        return $this->render('voyage_organise/index.html.twig', [
            'voyage_organises' => $voyageOrganises,
        ]);
    }else{
        return $this->redirectToRoute('security_login');
    }
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



  /**
     * @Route("/test", name="indexTest", methods={"GET"})
     */

    public function listVoys(VoyageOrganiseRepository $repo):Response
    {

        $voyageOrganises = $repo->findListaVoyages();
        
      //$l=sizeof($voyageOrganises);
        //echo "alert('$l');";
      
        return $this->render('user/listvoy.html.twig', [
            'voyageOrganises' => $voyageOrganises,
        ]);
    }
    
 /**
     * @Route("/rr/{idv}/{idu}", name="indexRes", methods={"GET","POST"})
     */
     public function testresr(EntityManagerInterface $entityManager,
     UserRepository $repu,VoyageOrganiseRepository $rep,User $user,VoyageOrganise $voyage,
     VoyageOrganise $voyageorg,Request $request,Session  $session): Response
    {
              $idu=$session->get('Idu');
            //$voyage = $repo->findByIdv($voyageorg->getIdv()->getIdv(),$voyageorg->getIdvo());

           
        $rv = new ReservationVoyage();
        $form = $this->createForm(RsrvType::class, $rv);
        //$form->add("Reserver", SubmitType::class);
         //$ch=sizeof($voyage);
//echo $ch;
$form->get('idv')->setData($voyageorg->getIdv());
        
$form->get('idu')->setData($user);
        $form->handleRequest($request);
       
   $user = $repu->findByIdu($idu);
        
      
  


           
        if ($form->isSubmitted() && $form->isValid()) {

         
            $dateDebut=$rv->getDateDepart()->format("Y-m-d");
            $timestamp1 = strtotime($dateDebut);

            $dateArrivee=$rv->getDateArrivee()->format("Y-m-d");
            $timestamp2 = strtotime($dateArrivee);

            if ($timestamp2 <$timestamp1) {
                echo "<script > alert('date depart akber mel date arrivee ')</script>";
            }
           
            if ($timestamp2 >$timestamp1) {
                echo "<script > alert(' date arrive akber m date depart')</script>";
                $rv->setEtat('NON PAYE');
                $rv->setIdu($user);
                $rv->setIdv($voyageorg->getIdv());


                $entityManager->persist($rv);
                $entityManager->flush();

                //$voyage = $rep->findByNbPlaces($voyageorg->getIdvo(),$rv->getIdv()->getIdv());
                $voyageorg->setNbplaces($voyageorg->getNbplaces()-1);
                $entityManager->flush();
            }
        }
           
           // return $this->redirectToRoute('indexRes', [], Response::HTTP_SEE_OTHER);

                 
              

        return $this->render('reservation_voyage/reservUser.html.twig', [
            'rv' => $rv,
            'voyageorg'=>$voyageorg,
            'user'=>$user,
             
           
            'form' => $form->createView(),
        ]);
    }

}
