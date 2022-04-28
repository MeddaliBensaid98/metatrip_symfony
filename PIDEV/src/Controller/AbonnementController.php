<?php

namespace App\Controller;

use App\Entity\Abonnement;
use App\Entity\Activites;
use App\Repository\AbonnementRepository;
use App\Controller\FlashyNotifier;
use App\Form\AbonnementType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use Knp\Component\Pager\PaginatorInterface;
use MercurySeries\FlashyBundle\DependencyInjection\MercurySeriesFlashyExtension;

use AppBundle\Form\DataTransformer\TimestampToDateTimeTransformer;

/**
 * @Route("/abonnement")
 */
class AbonnementController extends AbstractController
{
    /**
     * @Route("/", name="app_abonnement_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $abonnements = $entityManager
            ->getRepository(Abonnement::class)
            ->findAll();



        return $this->render('abonnement/index.html.twig', [
            'abonnements' => $abonnements,
        ]);
    }

    /**
     * @Route("/new", name="app_abonnement_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $abonnement = new Abonnement();
        $abonnement->setDateAchat( new \DateTime('now'));

        $form = $this->createForm(AbonnementType::class, $abonnement);

        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($abonnement);
            $entityManager->flush();




        }

        return $this->render('abonnement/new.html.twig', [
            'abonnement' => $abonnement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{ida}", name="app_abonnement_show", methods={"GET"})
     */
    public function show(Abonnement $abonnement): Response
    {
        return $this->render('abonnement/show.html.twig', [
            'abonnement' => $abonnement,
        ]);
    }

    /**
     * @Route("/{ida}/edit", name="app_abonnement_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Abonnement $abonnement, EntityManagerInterface $entityManager, \Swift_Mailer $mailer): Response
    {
        $form = $this->createForm(AbonnementType::class, $abonnement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();


           if ($abonnement->getType()=="Gold"){
            $message = (new \Swift_Message('New'))

                ->setFrom('withthisvision@gmail.com')

                ->setTo('zakaria.dafdouf@esprit.tn')

                ->setSubject('[Abonnement a ete modifie avec succes]')


                ->setBody(
                    $this->renderView(
                        'Emails/contact.html.twig'),

                    'text/html'
                );


            $mailer->send($message);}

            return $this->redirectToRoute('app_abonnement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('abonnement/edit.html.twig', [
            'abonnement' => $abonnement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{ida}", name="app_abonnement_delete",  methods={"POST"})
     */
    public function delete(Request $request, Abonnement $abonnement, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$abonnement->getIda(), $request->request->get('_token'))) {
            $entityManager->remove($abonnement);
            $entityManager->flush();


        }

        return $this->redirectToRoute('app_abonnement_index', [], Response::HTTP_SEE_OTHER);
    }




}
