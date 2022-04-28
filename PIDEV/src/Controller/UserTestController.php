<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\User1Type;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user/test")
 */
class UserTestController extends AbstractController
{
    /**
     * @Route("/", name="app_user_test_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $users = $entityManager
            ->getRepository(User::class)
            ->findAll();

        return $this->render('user_test/index.html.twig', [
            'users' => $users,
        ]);
    }

    /**
     * @Route("/new", name="app_user_test_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(User1Type::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_user_test_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user_test/new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idu}", name="app_user_test_show", methods={"GET"})
     */
    public function show(User $user): Response
    {
        return $this->render('user_test/show.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/{idu}/edit", name="app_user_test_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(User1Type::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_user_test_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user_test/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idu}", name="app_user_test_delete", methods={"POST"})
     */
    public function delete(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getIdu(), $request->request->get('_token'))) {
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_user_test_index', [], Response::HTTP_SEE_OTHER);
    }
}
