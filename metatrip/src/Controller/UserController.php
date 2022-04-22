<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Form\User1Type;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use App\Repository\VoyageOrganiseRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/user")
 */
class UserController extends AbstractController
{

   
    /**
     * @Route("/", name="app_user_index", methods={"GET"})
     */
    public function index(Session $session, Request $request, EntityManagerInterface $entityManager,PaginatorInterface $paginator): Response
    {
 
   
   
        $users = $entityManager
            ->getRepository(User::class)
            ->findAll();
            
   // Paginate the results of the query
   $appointments = $paginator->paginate(
    // Doctrine Query, not results
    $users,
    // Define the page parameter
    $request->query->getInt('page', 1),
    // Items per page
    5
);
if( $session->get('login')=="true"){
    return $this->render('user/index.html.twig', [
        'users' => $appointments     
    ]);
}else{
    return $this->redirectToRoute('security_login');
}

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
    public function new(Session  $session,Request $request, EntityManagerInterface $entityManager): Response
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
   

        if( $session->get('login')=="true"){
        return $this->render('user/new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }else{
        return $this->redirectToRoute('security_login');
    }  
    }
    /**
     * @Route("/{idu}", name="app_user_show", methods={"GET"})
     */
    public function show(Session $session,User $user): Response
    {
        if( $session->get('login')=="true"){
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }else{
        return $this->redirectToRoute('security_login');
    } 
    }

    /**
     * @Route("/{idu}/edit", name="app_user_edit", methods={"GET", "POST"})
     */
    public function edit(Session $session,Request $request, User $user, EntityManagerInterface $entityManager): Response
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
        if( $session->get('login')=="true"){
        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }else{
        return $this->redirectToRoute('security_login');
    } 
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
    public function voyagelist(Session $session,EntityManagerInterface $entityManager,VoyageOrganiseRepository $repo): Response
    {
        $voyageOrganises = $repo->findListaVoyages();
        
        //$l=sizeof($voyageOrganises);
          //echo "alert('$l');";
          if( $session->get('login')=="true"){
          return $this->render('user/listvoy.html.twig', [
              'voyageOrganises' => $voyageOrganises,
          ]);
        }else{
            return $this->redirectToRoute('security_login');
        } 
    }

/**
     * @Route("/trirole/10/user", name="triroleuser_99")
    */
    public function orderByROLE(EntityManagerInterface $entityManager,UserRepository $repository,Request $request,PaginatorInterface $paginator)
    {  $allRole = $repository->orderByROLE();
       // Paginate the results of the query
   $appointments = $paginator->paginate(
    // Doctrine Query, not results
    $allRole,
    // Define the page parameter
    $request->query->getInt('page', 1),
    // Items per page
    5
);
        return $this->render('user/index.html.twig', [
            'users' => $appointments,
        
        ]);
    }   
  }