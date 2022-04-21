<?php

namespace App\Controller;

use App\Entity\Localisationvoyage;
use App\Entity\User;
use App\Entity\Voyage;
use App\Entity\VoyageOrganise;

use App\Form\UserType;
use App\Form\User1Type;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\VoyageOrganiseRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\LocalisationvoyageRepository;

/**
 * @Route("/user")
 */
class UserController extends AbstractController
{
  
    /**
     * @Route("/", name="app_user_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        
        $users = $entityManager
            ->getRepository(User::class)
            ->findAll();

        return $this->render('user/index.html.twig', [
            'users' => $users,
        ]);
    }

       /**
     * @Route("/admin", name="indexAdmin", methods={"GET"})
     */
    public function indexAdmin(EntityManagerInterface $entityManager,Session $session): Response
    {$user=$session->get('email');

        return $this->render('Admin/index.html.twig',[
            'users' => $user
        ]);
    }
    /**
     * @Route("/new", name="app_user_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if(($user->getCin()==null) ||($user->getNom()==null)||($user->getPrenom()==null)||($user->getDatenaissance()==null)|| ($user->getImageFile()==null)){
                echo "<script > alert('Form error')</script>";
            }
            else{
                $hash = password_hash($user->getPassword(), PASSWORD_DEFAULT);
                       # $encoded = $encoder->encodePassword($user,$user->getPassword());
                       $user->setPassword($hash);
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
            }
              
        }

        return $this->render('user/new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }




 

    /**
     * @Route("/{idu}", name="app_user_show", methods={"GET"})
     */
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }



    /**
     * @Route("/map/test", name="app_mapp_show", methods={"GET","POST"})
     */
    public function openMap( LocalisationvoyageRepository $repo,EntityManagerInterface $entityManager): Response
    {     
         $voyageCoord = $repo->findCoordonne();

         $localisations = $entityManager
         ->getRepository(Localisationvoyage::class)
         ->findAll();

        $voyOrg=$entityManager
        ->getRepository(VoyageOrganise::class)
        ->findAll();

  
        return $this->render('user/map.html.twig', [
            
       
            'voyageCoord'=>$voyageCoord,
            '$voyOrg'=>$voyOrg,
   
            'localisations'=>$localisations
        ]);
    }



    

    /**
     * @Route("/{idu}/edit", name="app_user_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(User1Type::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $email = $user->getEmail();
            echo "<script > console.log('$email')</script>";
            $em=$this->getDoctrine()->getRepository(User::class);
          $VarName = $em->findOneBy(['email'=>$email]);
           $user->setPassword($VarName->getPassword());
          $entityManager->flush();

           return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idu}", name="app_user_delete", methods={"POST"})
     */
    public function delete(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getIdu(), $request->request->get('_token'))) {
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
    }
    


    /**
     * @Route("/user/voyage", name="voyagelist", methods={"GET"})
     */
    public function voyagelist(EntityManagerInterface $entityManager,VoyageOrganiseRepository $repo): Response
    {
        $voyageOrganises = $repo->findListaVoyages();
        
        //$l=sizeof($voyageOrganises);
          //echo "alert('$l');";
        
          return $this->render('user/listvoy.html.twig', [
              'voyageOrganises' => $voyageOrganises,
          ]);
    }



  /**
     * @Route("/home/stat", name="homeSt", methods={"GET"})
     */
    public function statvist(EntityManagerInterface $entityManager,VoyageOrganiseRepository $repo): Response
    {
      


 


        $lista=$repo->stat();
        $lista2=$repo->stat2();

        $n=sizeof($lista);
    
 
          return $this->render('stats/stat.html.twig', [
              'lista' => $lista,
              'lista2' => $lista2,
              'n'=>$n

          ]);
    }




}