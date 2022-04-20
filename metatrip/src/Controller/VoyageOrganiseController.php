<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
// Include PhpSpreadsheet required namespaces
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\ReservationVoyage;
 
use App\Entity\Voyage;
use App\Entity\User;
use App\Repository\VoyageOrganiseRepository;
use App\Repository\UserRepository;

use App\Form\RsrvType;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Entity\VoyageOrganise;
use App\Form\VoyageOrganiseType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/voyage_organise")
 */
class VoyageOrganiseController extends AbstractController
{
    /**
     * @Route("/", name="app_voyage_organise_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager,VoyageOrganiseRepository $repo): Response
    {$PublicIP = $_SERVER['REMOTE_ADDR'];
     
        
        $voyageOrganises = $repo->findListaVoyages();

        //echo "<script > alert('$region'); </script>";  
              return $this->render('voyage_organise/index.html.twig', [
            'voyage_organises' => $voyageOrganises,
             
        ]);
    }



   /**
     * @Route("/excel", name="app_voyage_organise_excel", methods={"GET"})
     */
    public function createSpreadsheet(VoyageOrganiseRepository $repo)
{

      $columnValues = $repo->findListaVoyages();
    $spreadsheet = new Spreadsheet();
        
    /* @var $sheet \PhpOffice\PhpSpreadsheet\Writer\Xlsx\Worksheet */
    $sheet = $spreadsheet->getActiveSheet();
   
    $columnNames = [
        'ID Voy',
        'ID Voy ORG',
        'Prix Billet',
        'Nb places',
        'Nb nuitees',
        'Airline',
        'Etat voyage',
        'Image',
        'Pays'

    ];
    $columnLetter = 'A';
    foreach ($columnNames as $columnName) {
        // Allow to access AA column if needed and more
        $columnLetter++;
        $sheet->setCellValue($columnLetter.'2', $columnName);
    }



    $i = 3;
    
    foreach ($columnValues as $columnValue) {
        $columnLetter = 'A';
        foreach ($columnValue as $value) {
            $columnLetter++;
            $sheet->getStyle($columnLetter.'2')->getFont()->setBold(true);
        
            $sheet->setCellValue($columnLetter.$i, $value);
        }
        $i++;
    }
    $sheet->setTitle("Voyage Organise & voyages List");
    
    // Create your Office 2007 Excel (XLSX Format)
    $writer = new Xlsx($spreadsheet);
    
    // Create a Temporary file in the system
    $fileName = 'Voyage Organise & voyages.xlsx';
    $temp_file = tempnam(sys_get_temp_dir(), $fileName);
    
    // Create the excel file in the tmp directory of the system
    $writer->save($temp_file);
    
    // Return the excel file as an attachment
    return $this->file($temp_file, $fileName, ResponseHeaderBag::DISPOSITION_INLINE);
}


/**
     * @Route("/upload-excel", name="app_voyage_organise_uexcel")
     */
    public function uploadExcel(VoyageOrganiseRepository $repo)
    {
      




        
        $spreadsheet = IOFactory::load(__DIR__ . '/../../public/uploads/voyOrg.xlsx'); // Here we are able to read from the excel file 
        $row = $spreadsheet->getActiveSheet()->removeRow(1); // I added this to be able to remove the first file line 
        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true); // here, the read data is turned into an array
        $entityManager = $this->getDoctrine()->getManager(); 
        foreach ($sheetData as $Row) 
            { 
    
                $prixBillet = $Row['A'];
                $nbPlaces = $Row['B']; 
                $airline= $Row['C'];     
                $etatVoyage = $Row['D'];
                $idv = $Row['E'];    
              //  $user_existant = $entityManager->getRepository(VoyageOrganise::class)->findOneBy(array('idvo' => $email)); 
                    // make sure that the user does not already exists in your db 
               // if (!$user_existant) 
               //  {   
                $voyage = $entityManager->getRepository(Voyage::class)->findOneBy(array('idv' => $idv));
                $voyageOrganises = $repo->findListaVoyages();
                if (!$voyage) {  echo "<script > alert('Voyage incorrect ! ')</script>";
                    return $this->render('voyage_organise/index.html.twig', [
                        'voyage_organises' => $voyageOrganises,
                         
                    ]); 
                
                }

                else {
                    $voyage_organise = new VoyageOrganise();
                    $voyage_organise->setPrixBillet($prixBillet);
                    $voyage_organise->setNbplaces($nbPlaces);
                    $voyage_organise->setNbNuitees(0);
                    $voyage_organise->setAirline($airline);
                    $voyage_organise->setEtatvoyage($etatVoyage);
                    $voyage_organise->setIdv($voyage);
                    $entityManager->persist($voyage_organise);
                    $entityManager->flush();

                    echo "<script > alert('Voyage Organié importé avec succés ! ')</script>";
                 }
             }
      

             
             return $this->render('voyage_organise/index.html.twig', [
           'voyage_organises' => $voyageOrganises,
            
       ]); 
            

      
             
             
        
    }



    /**
     * @Route("/new", name="app_voyage_organise_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {//Gets the IP Address from the visitor

        $voyageOrganise = new VoyageOrganise();
        $form = $this->createForm(VoyageOrganiseType::class, $voyageOrganise);
        $form->handleRequest($request);
 
        if ($form->isSubmitted() && $form->isValid()) {
            $voyageOrganise->setNbNuitees(0);

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
        $voyageOrganise->setNbNuitees(0);
   $x=$voyageOrganise->getAirline();
   
        
        if ($form->isSubmitted() ) {
       

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
     * @Route("/test/t", name="indexTest", methods={"GET"})
     */

    public function listVoys(VoyageOrganiseRepository $repo)
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
     VoyageOrganise $voyageorg,Request $request): Response
    {
              $idu=813;
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
