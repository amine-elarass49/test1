<?php

namespace App\Controller;

use App\Entity\MarqueProduit;
use App\Form\MarqueProduitType;
use App\Repository\MarqueProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/marque/produit")
 */
class MarqueProduitController extends AbstractController
{
    /**
     * @Route("/", name="marque_produit_index", methods={"GET"})
     */
    public function index(MarqueProduitRepository $marqueProduitRepository): Response
    {
        return $this->render('marque_produit/index.html.twig', [
            'marque_produits' => $marqueProduitRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="marque_produit_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $marqueProduit = new MarqueProduit();
        $form = $this->createForm(MarqueProduitType::class, $marqueProduit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($marqueProduit);
            $entityManager->flush();

            return $this->redirectToRoute('marque_produit_index');
        }

        return $this->render('marque_produit/new.html.twig', [
            'marque_produit' => $marqueProduit,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{marque_id}", name="marque_produit_show", methods={"GET"})
     */
    public function show(MarqueProduit $marqueProduit): Response
    {
        return $this->render('marque_produit/show.html.twig', [
            'marque_produit' => $marqueProduit,
        ]);
    }

    /**
     * @Route("/{marque_id}/edit", name="marque_produit_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, MarqueProduit $marqueProduit): Response
    {
        $form = $this->createForm(MarqueProduitType::class, $marqueProduit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('marque_produit_index');
        }

        return $this->render('marque_produit/edit.html.twig', [
            'marque_produit' => $marqueProduit,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{marque_id}", name="marque_produit_delete", methods={"DELETE"})
     */
    public function delete(Request $request, MarqueProduit $marqueProduit): Response
    {
        if ($this->isCsrfTokenValid('delete'.$marqueProduit->getMarque_id(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($marqueProduit);
            $entityManager->flush();
        }

        return $this->redirectToRoute('marque_produit_index');
    }
}
