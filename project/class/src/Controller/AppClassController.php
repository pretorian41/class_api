<?php

namespace App\Controller;

use App\Entity\AppClass;
use App\Form\AppClassType;
use App\Repository\AppClassRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/app/class")
 */
class AppClassController extends AbstractController
{
    /**
     * @Route("/", name="app_class_index", methods={"GET"})
     */
    public function index(AppClassRepository $appClassRepository): Response
    {
        return $this->render('app_class/index.html.twig', [
            'app_classes' => $appClassRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_class_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $appClass = new AppClass();
        $form = $this->createForm(AppClassType::class, $appClass);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($appClass);
            $entityManager->flush();

            return $this->redirectToRoute('app_class_index');
        }

        return $this->render('app_class/new.html.twig', [
            'app_class' => $appClass,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_class_show", methods={"GET"})
     */
    public function show(AppClass $appClass): Response
    {
        return $this->render('app_class/show.html.twig', [
            'app_class' => $appClass,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_class_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, AppClass $appClass): Response
    {
        $form = $this->createForm(AppClassType::class, $appClass);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('app_class_index');
        }

        return $this->render('app_class/edit.html.twig', [
            'app_class' => $appClass,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_class_delete", methods={"DELETE"})
     */
    public function delete(Request $request, AppClass $appClass): Response
    {
        if ($this->isCsrfTokenValid('delete'.$appClass->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($appClass);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_class_index');
    }
}
