<?php

namespace App\Controller;

use App\Entity\AppClass;
use App\Form\AppClassType;
use App\Repository\AppClassRepository;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Swagger\Annotations as SWG;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;

/**
 * @Route("/app/class")
 */
class AppClassController extends AbstractFOSRestController
{
    /**
     * @param AppClassRepository $appClassRepository
     *
     * @return Response
     *
     * @SWG\Response(
     *     response=200,
     *     description="success",
     * ),
     *
     * @Route("/", name="app_class_list", methods={"GET"})
     */
    public function index(AppClassRepository $appClassRepository): Response
    {
        return $this->handleView($this->view($appClassRepository->findAll()));
    }

    /**
     * @param Request $request
     *
     * @return Response
     *
     * @Route("/new", name="app_class_new", methods={"POST"})
     *
     * @SWG\Post(
     *     path="/app/class/new",
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *         name="name",
     *         in="formData",
     *         description="name",
     *         type="string",
     *     ),
     *     @SWG\Parameter(
     *         name="active",
     *         in="formData",
     *         description="active",
     *         type="boolean",
     *     ),
     *     @SWG\Parameter(
     *         name="creationDate",
     *         in="formData",
     *         description="creationDate",
     *         type="string",
     *         format="yyyy-MM-dd HH:mm"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Success"
     *     ),
     *     @SWG\Response(
     *         response=400,
     *         description="form not valid"
     *     )
     * )
     */
    public function new(Request $request): Response
    {
        $requestVars = $request->request;
        $requestVars->set('active', 'true' === $requestVars->get('active') ? true : false);
        $appClass = new AppClass();
        $form = $this->createForm(AppClassType::class, $appClass);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($appClass);
            $entityManager->flush();

            return $this->handleView($this->view(
                ['status' => 'ok'],
                Response::HTTP_CREATED
            ));
        }

        return $this->handleView($this->view($form->getErrors(), 400));
    }

    /**
     * @param AppClass $appClass
     *
     * @return Response
     *
     * @Route("/{id}", name="app_class_show", methods={"GET"})
     */
    public function show(AppClass $appClass): Response
    {
        return $this->handleView($this->view($appClass));
    }

    /**
     * @param Request  $request
     * @param AppClass $appClass
     *
     * @return Response
     *
     * @Route("/{id}/edit", name="app_class_edit", methods={"POST"})
     *
     * @SWG\Post(
     *     path="/app/class/{id}/edit",
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *         name="name",
     *         in="formData",
     *         description="name",
     *         type="string",
     *     ),
     *     @SWG\Parameter(
     *         name="active",
     *         in="formData",
     *         description="active",
     *         type="boolean",
     *     ),
     *     @SWG\Parameter(
     *         name="creationDate",
     *         in="formData",
     *         description="creationDate",
     *         format="yyyy-MM-dd HH:mm",
     *         type="string",
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Success"
     *     ),
     *     @SWG\Response(
     *         response=400,
     *         description="form not valid"
     *     )
     * )
     **/
    public function edit(Request $request, AppClass $appClass): Response
    {
        $requestVars = $request->request;
        $requestVars->set('active', 'true' === $requestVars->get('active') ? true : false);
        $appClass = new AppClass();
        $form = $this->createForm(AppClassType::class, $appClass);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->handleView($this->view(
                ['status' => 'ok'],
                Response::HTTP_CREATED
            ));
        }

        return $this->handleView(
            $this->view($form->getErrors(), 400)
        );
    }

    /**
     * @param Request  $request
     * @param AppClass $appClass
     *
     * @return Response
     *
     * @Route("/{id}", name="app_class_delete", methods={"DELETE"})
     */
    public function delete(Request $request, AppClass $appClass): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($appClass);
        $entityManager->flush();

        return $this->handleView($this->view(
            ['status' => 'ok'],
            Response::HTTP_CREATED
        ));
    }
}
