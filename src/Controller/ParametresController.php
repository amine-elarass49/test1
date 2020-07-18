<?php

namespace App\Controller;

use App\Entity\Parametres;
use App\Form\ParametresType;
use App\Repository\ParametresRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/parametres")
 */
class ParametresController extends AbstractController
{
    /**
     * @Route("/", name="parametres_index", methods={"GET"})
     */
    public function index(ParametresRepository $parametresRepository): Response
    {
        return $this->render('parametres/index.html.twig', [
            'parametres' => $parametresRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="parametres_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $parametre = new Parametres();
        $form = $this->createForm(ParametresType::class, $parametre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($parametre);
            $entityManager->flush();

            return $this->redirectToRoute('parametres_index');
        }

        return $this->render('parametres/new.html.twig', [
            'parametre' => $parametre,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{par_id}", name="parametres_show", methods={"GET"})
     */
    public function show(Parametres $parametre): Response
    {
        return $this->render('parametres/show.html.twig', [
            'parametre' => $parametre,
        ]);
    }

    /**
     * @Route("/{par_id}/edit", name="parametres_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Parametres $parametre): Response
    {
        $form = $this->createForm(ParametresType::class, $parametre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('parametres_index');
        }

        return $this->render('parametres/edit.html.twig', [
            'parametre' => $parametre,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{par_id}", name="parametres_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Parametres $parametre): Response
    {
        if ($this->isCsrfTokenValid('delete'.$parametre->getPar_id(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($parametre);
            $entityManager->flush();
        }

        return $this->redirectToRoute('parametres_index');
    }
}
