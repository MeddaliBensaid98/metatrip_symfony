<?php

namespace App\Controller;


use App\Entity\User;

use App\Form\LoginType;
use Twilio\Rest\Client;
use App\Form\InscriptionType;
use App\Form\motePassFormType;
use Doctrine\Persistence\ObjectManager;
use App\Security\LoginFormAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Console\Output\NullOutput;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Guard\AuthenticatorInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class SecurityController extends AbstractController
{
   /**
     * @Route("/inscription", name="security_registration")
     */
    public function registration(\Swift_Mailer $mailer,Request $request, EntityManagerInterface $manager,UserPasswordEncoderInterface  $encoder)
     {  
       
    $user = new User();
    $form = $this->createForm(InscriptionType::class,$user);
    $form->handleRequest($request);

if($form->isSubmitted() && $form->isValid()) {


   $email = $user->getEmail();
   echo "<script > console.log('$email')</script>";
   
   $em=$this->getDoctrine()->getRepository(User::class);
   $VarName = $em->findOneBy(['email'=>$email]);
   
   if( is_null($VarName)){
       
    $pass=$user->getPassword();
    $hash = password_hash($user->getPassword(), PASSWORD_DEFAULT);
    $user->setPassword($hash);       
    $manager->persist($user);
    $manager->flush();
    $message = (new \Swift_Message('Hello Email'))
    ->setFrom('solidev.3a18@gmail.com')
    ->setTo($email)
    ->setBody(' <center><img src="https://pbs.twimg.com/profile_images/1118720684950085632/Qc9LxLu0_400x400.png" alt="Girl in a jacket" height=50%;width=50%></center><center><h2>bienvenue sur notre site  Metatrip</h2> <br><h4>une fois metatrip!toujour metatrip </h4></center></br></center><center><h3>voici les coordonnéesde votre compte:</h3></center><br><center>Email:'.$email.'</center><br><center>Password:'.$pass.'</center></br>','text/html')
;
$mailer->send($message);
    $this->addFlash('message', 'Le message a bien été envoyé');
    return $this->redirectToRoute('security_login');
   }else{
    echo "<script > console.log('email est deja utilise')</script>";
    echo "<script > alert('email est deja utilise')</script>";
   }


 

}


    return $this->render('security/registration.html.twig', [
        'form' => $form->createView()
    ]);
}


    /**
     * @Route("/login", name="security_login")
     */
    public function login(Request $request, EntityManagerInterface $manager,UserPasswordEncoderInterface  $encoder,Session  $session, GuardAuthenticatorHandler $handler,
   )
    {  

        $session->set('login',"false"); 
        $session->start();
        echo "<script> console.log('TEST')</script>";
        $ok=false;
        $user = new User();
        $form = $this->createForm(LoginType::class,$user);
        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid()) {
          //  $email=$request->request->get('email');    
          
            echo "<script > console.log('sssssssssss')</script>";
            
            $email = $user->getEmail();
           
    
            $em=$this->getDoctrine()->getRepository(User::class);
            $VarName = $em->findOneBy(['email'=>$email]);
                $Role=$user->getRole();
                echo "<script > console.log('$email')</script>";
       
                if( is_null($VarName)) {
                    echo "<script >  console.log('fergha')</script>";
                        
                  return $this->redirectToRoute('security_login');
                          
                    }  else{
                        $hash = password_hash($user->getPassword(), PASSWORD_DEFAULT);
                       # $encoded = $encoder->encodePassword($user,$user->getPassword());
                        $pass=$VarName->getPassword();
                   $pass1= $user->getPassword();
                   
                  
                   echo "<script >  console.log( '$hash')</script>";
                    if (password_verify($user->getPassword(),$VarName->getPassword())) {
                        echo "<script >  console.log('shiha')</script>";
               
                    

                                           
                                             //getPrenom()
                                            // getNom()
                                        // $session->start();     
                        // stores an attribute in the session for later reuse
                        $session->set('Prenom', $VarName->getPrenom() );
                        $session->set('Email', $VarName->getEmail() );
                        $session->set('Nom', $VarName->getNom() );
                        $session->set('Idu', $VarName->getIdu() );
                        $session->set('Image',$VarName->getImage());
                        $session->set('login',"true"); 
                        $session->start();

                        if($VarName->getRole()==0){

                         return $this->redirectToRoute('voyagelist');
                        }
                        else{


                           

                           // var_dump($session->get('user'));
                   //Print null
                    return $this->redirectToRoute('app_user_index');
                        }
                  
                        /*echo "<script >localStorage.setItem('email', '$email');</script>";
                        echo "<script >localStorage.setItem('Role', '$Role');</script>";    
                      
                          echo "<script >localStorage.setItem('email', '$email');</script>";
                          echo "<script >localStorage.setItem('Role', '$Role');</script>";    */
    
                    } else {
                        echo "<script >  console.log('ghalta')</script>";
                            return $this->redirectToRoute('security_login');
                    }
                #    echo "<script >  console.log('$encoded')</script>";
                  #  echo "<script >  console.log('$pass')</script>";
                 #   $bar = substr($encoded,0,7) ;
                   # $bar2 = substr($pass,0,7) ;
                  #  echo "<script >  console.log('$bar')</script>";
                   # echo "<script >  console.log('$bar2')</script>";
                   /* if($bar==$bar2){
                        echo "<script >localStorage.setItem('email', '$email');</script>";
                        echo "<script >localStorage.setItem('Role', '$Role');</script>";             
                        $ok=true;
                        echo "<script >  console.log('welcome')</script>";
                       # return $this->redirectToRoute('indexAdmin');
                    }else{
                       # return $this->redirectToRoute('security_login');
                    
                    } 
                    */
                    }
                }
            
return $this->render('security/login.html.twig', [
    'form' => $form->createView()
]);
    }
      /**
     * @Route("/logout", name="logout")
     */
    public function logout(Session  $session)
    {
       
        $session->clear();
        return $this->redirectToRoute('security_login');
  
  
    }
  /**
     * @Route("/motedepassoublie", name="motedepassoublie")
     */
    public function motedepassoublie(Request $request, EntityManagerInterface $manager,UserPasswordEncoderInterface  $encoder,Session  $session, GuardAuthenticatorHandler $handler,
   )
    {    $user = new User();
        $form = $this->createForm(motePassFormType::class,$user);
        $form->handleRequest($request);
    


        if($form->isSubmitted() ) {
            $tel = $user->getTel();
            $em=$this->getDoctrine()->getRepository(User::class);
            $VarName = $em->findOneBy(['tel'=>$tel]);
            if( is_null($VarName)==false){
                $motdepass="0000";
               $user= $VarName;
            
                
                $hash = password_hash($user->getPassword(), PASSWORD_DEFAULT);
                $user->setPassword( $hash); 
                $manager->flush();
                $sid    = "AC0c322b9cef5473f69e18c0d8bdf226e3"; 
$token  = "ecb1006f326ee0803c0592a8da5dba24"; 
$twilio = new Client($sid, $token); 
 
$message = $twilio->messages 
                  ->create("+21650480316", // to 
                           array(  
                               "messagingServiceSid" => "MG09a0f595a98c1544d6a4068c212ba887",      
                               "body" => "Metatrip:Voici votre mot de pass est 0000" 
                           ) 
                  ); 
 
print($message->sid);
                return $this->redirectToRoute('security_login');
               }else{
                echo "<script > console.log('Tel ')</script>";
                echo "<script > alert('tel n est pas exist')</script>";
               }
        }
        return $this->render('security/motdepassoblie.html.twig', [
            'form' => $form->createView()
        ]);
    }


   
    /**
     * @Route("/Security/Security/mobile/loginuser/", name="security_login_mobile", methods={"GET"})
     */
    public function loginmobile(NormalizerInterface $serializer,Request $request, EntityManagerInterface $manager,UserPasswordEncoderInterface  $encoder,Session  $session, GuardAuthenticatorHandler $handler,
   )
    {  
    
    
        $ok=false;
   
      

       
          //  $email=$request->request->get('email');    
          
          
            $email =  $request->get("email");
           
    
            $em=$this->getDoctrine()->getRepository(User::class);
            $VarName = $em->findOneBy(['email'=>$email]);
              //  $Role=$user->getRole();
              
                if( is_null($VarName)) {
                    return new Response("login failed");  
                    }  else{
                        $hash = password_hash($request->get("password"), PASSWORD_DEFAULT);
                       # $encoded = $encoder->encodePassword($user,$user->getPassword());
                        $pass=$VarName->getPassword();
                  
                  
              
                    if (password_verify($request->get("password"),$pass)) {
                      
                   
                 
                        return new Response("login done");  
                        /*echo "<script >localStorage.setItem('email', '$email');</script>";
                        echo "<script >localStorage.setItem('Role', '$Role');</script>";    
                      
                          echo "<script >localStorage.setItem('email', '$email');</script>";
                          echo "<script >localStorage.setItem('Role', '$Role');</script>";    */
    
                    } else {
                     
                        return new Response("login failed");  
                    }
                #    echo "<script >  console.log('$encoded')</script>";
                  #  echo "<script >  console.log('$pass')</script>";
                 #   $bar = substr($encoded,0,7) ;
                   # $bar2 = substr($pass,0,7) ;
                  #  echo "<script >  console.log('$bar')</script>";
                   # echo "<script >  console.log('$bar2')</script>";
                   /* if($bar==$bar2){
                        echo "<script >localStorage.setItem('email', '$email');</script>";
                        echo "<script >localStorage.setItem('Role', '$Role');</script>";             
                        $ok=true;
                        echo "<script >  console.log('welcome')</script>";
                       # return $this->redirectToRoute('indexAdmin');
                    }else{
                       # return $this->redirectToRoute('security_login');
                    
                    } 
                    */
                    }
                    
                
               // return new Response(json_encode($data));
    }

    /**
     * @Route("/Security/isncri/insciptionMobile/", name="sdsd", methods={"GET"})
     */
    public function insciptionMobile(Request $request, EntityManagerInterface $manager,UserPasswordEncoderInterface  $encoder)
     {  
        $user = new User();
        $email =  $request->get("email");



  
  
   
   $em=$this->getDoctrine()->getRepository(User::class);
   $VarName = $em->findOneBy(['email'=>$email]);
   
   if( is_null($VarName)){
       $user->setEmail($email);
    $pass=$request->get("password");
    $hash = password_hash( $pass, PASSWORD_DEFAULT);
    $user->setPassword($hash);
    $user->setCin($request->get("cin")) ; 
    $user->setNom($request->get("nom")) ;  
    $user->setPrenom($request->get("prenom")) ; 
    $user->setEmail($request->get("email")) ;   
    $user->setTel($request->get("tel")) ;  
    $user->setImage($request->get("image")) ;
    $user->setDatenaissance($request->get("datenaissance")) ; 
    $manager->persist($user);
    $manager->flush();
  
    return new Response("inscription done");  
   }else{
    return new Response("inscription failed");  
   }



}
}