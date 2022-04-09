<?php

namespace App\Controller;


use App\Entity\User;

use App\Form\LoginType;
use App\Form\InscriptionType;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Console\Output\NullOutput;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class SecurityController extends AbstractController
{
   /**
     * @Route("/inscription", name="security_registration")
     */
    public function registration(Request $request, EntityManagerInterface $manager,UserPasswordEncoderInterface  $encoder)
     {
    $user = new User();
    $form = $this->createForm(InscriptionType::class,$user);
    $form->handleRequest($request);
if($form->isSubmitted() && $form->isValid()) {
   $hash= $encoder->encodePassword($user,$user->getPassword());
   $user->setPassword($hash);
             
    $manager->persist($user);
    $manager->flush();
    return $this->redirectToRoute('security_login');

 

}


    return $this->render('security/registration.html.twig', [
        'form' => $form->createView()
    ]);
}


    /**
     * @Route("/login", name="security_login")
     */
    public function login(Request $request, EntityManagerInterface $manager,UserPasswordEncoderInterface  $encoder)
    {         echo "<script> console.log('TEST')</script>";
        $ok=false;
        $user = new User();
        $form = $this->createForm(LoginType::class,$user);
        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid()) {
            echo "<script > console.log('sssssssssss')</script>";
                $em=$this->getDoctrine()->getRepository(User::class);
                $email = $user->getEmail();
                echo "<script > console.log('$email')</script>";
                $VarName = $em->findOneBy(['email'=>$email]);
    
       
                if( is_null($VarName)) {
                               
                        
                                echo "<script> console.log('4558855')</script>";
                          
                    }  else{
                    $encoded = $encoder->encodePassword($user,$user->getPassword());
                    $pass=$VarName->getPassword();
                    $bar = substr($encoded,0,7) ;
                    $bar2 = substr($pass,0,7) ;
                    echo "<script >  console.log('$bar')</script>";
                    echo "<script >  console.log('$bar2')</script>";
                    if($bar==$bar2){
                                    
                        $ok=true;
                        echo "<script >  console.log('welcome')</script>";
            
                    }else{
                        echo "<script >  console.log('jemla');</script>";
                    
                    } 
                    }
                }
            
return $this->render('security/login.html.twig', [
    'form' => $form->createView()
]);
    }
}
