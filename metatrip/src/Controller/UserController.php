<?php

namespace App\Controller;

use DateTime;
use App\Entity\User;
use App\Form\UserType;
use App\Form\User1Type;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use App\Repository\VoyageOrganiseRepository;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/user")
 */
class UserController extends AbstractController
{

   
    /**
     * @Route("/", name="app_user_index", methods={"GET"})
     */
    public function index(SerializerInterface $serializer,NormalizerInterface $normalizer,Session $session, Request $request, EntityManagerInterface $entityManager,PaginatorInterface $paginator): Response
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


      
    /**
     * @Route("/get/users",name="getuserjason", methods={"GET"})
      * @return JsonResponse
      */
    public function getusers(SerializerInterface $serializer,NormalizerInterface $normalizer,Session $session, Request $request, EntityManagerInterface $entityManager): Response
    {
 
   
   
        $users = $entityManager
            ->getRepository(User::class)
            ->findAll();
            $JsonContent = $normalizer ->normalize($users);

            return new Response(json_encode($JsonContent));
    }

    /**
     * @Route("/supp/{idrec}", name="supp")
     */
    public function supp($idrec)
    {
        $user = $this->getDoctrine()->getRepository(User::class)->find($idrec);
        $em = $this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();
        return $this->redirectToRoute("getuserjason");

    }
    /**
     * @Route("/supp/supp/supprimerfrommobile/{idrec}", name="suppmobike")
     */
    public function suppmob($idrec)
    {
        $user = $this->getDoctrine()->getRepository(User::class)->find($idrec);
        $em = $this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();
      

        return new Response("done");

    }


 /**
     * @Route("/10/modifieruser/{idrec}" ,name="updatemob", methods={"GET"})
      * @return JsonResponse
     */
    public function update(Request $request,$idrec,NormalizerInterface $serializer){
        $rec=  $this->getDoctrine()->getManager()->getRepository(User::class)->find($idrec);
        
        $data = json_decode($request->getContent(), true);
        $rec->setCin( $request->get("cin"));
         $rec->setNom( $request->get("nom"));
         $rec->setPrenom( $request->get('prenom'));
         $rec->setTel($request->get("tel"));
         $rec->setEmail( $request->get("email"));
         $rec->setPassword( $request->get("password"));
         $rec->setImage( $request->get("image"));
    
        $rec->setDatenaissance($request->get("datenaissance"));
        $data=$serializer->normalize($rec);
      
        $em = $this->getDoctrine()->getManager();
        $em->flush();//mise a jour
        return new Response(json_encode($data));

    }

     /**
     * @Route("/t/adduser/", name="app_projet_adda", methods={"GET"})
     * @return JsonResponse
     */
    public function adduser(Request $request,NormalizerInterface $serializer,EntityManagerInterface $em):JsonResponse{
        $em = $this->getDoctrine()->getManager();
        $rec=new User();
     
        $rec->setCin((String)$request->get('cin') );
         $rec->setNom( (String)$request->get('nom'));
        $rec->setPrenom( (String)$request->get('prenom'));
        $rec->setTel( (String)$request->get("tel"));
        $rec->setEmail( (String)$request->get("email"));
        $rec->setPassword((String) $request->get("password"));
        $rec->setImage( (String)$request->get("image"));
       
     //  $ymd = DateTime::createFromFormat('m-d-Y', $request->query->get("datenaissance"))->format('Y-m-d');
     
   $date=  new \DateTime($request->get("datenaissance"));
     $rec->setDatenaissance($date);
        $em->persist($rec);
        $em->flush();
        $encoder = new JsonEncoder();
        $normalizer = new ObjectNormalizer();
        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object;
        });
        $serializer = new Serializer([$normalizer], [$encoder]);
        $formatted = $serializer->normalize($rec);
        return new JsonResponse($formatted);
    }


     /**
     * @Route("/findby/id/{idu}", name="findby", methods={"GET"})
     */
    public function showjson($idu,UserRepository $us,Request $request,NormalizerInterface $serializer,EntityManagerInterface $em):JsonResponse{
       $user=  $us->findOneBy(['idu' => $idu]);
   
       if ($user==null){return new JsonResponse(['reponse' => 'user inexistant'],Response::HTTP_NOT_FOUND);}
 
       $data=['idu'=>$user->getIdu(),'nom'=>$user->getNom(),'prenom'=>$user->getPrenom()];

            return new JsonResponse($data,Response::HTTP_OK);

    }
}