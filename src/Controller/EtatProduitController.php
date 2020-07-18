<?php

namespace App\Controller;

use App\Entity\EtatProduit;
use App\Form\EtatProduitType;
use App\Repository\EtatProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/etat/produit")
 */
class EtatProduitController extends AbstractController
{
    /**
     * @Route("/", name="etat_produit_index", methods={"GET"})
     */
    public function index(EtatProduitRepository $etatProduitRepository): Response
    {
        return $this->render('etat_produit/index.html.twig', [
            'etat_produits' => $etatProduitRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="etat_produit_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $etatProduit = new EtatProduit();
        $form = $this->createForm(EtatProduitType::class, $etatProduit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($etatProduit);
            $entityManager->flush();

            return $this->redirectToRoute('etat_produit_index');
        }

        return $this->render('etat_produit/new.html.twig', [
            'etat_produit' => $etatProduit,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{etat_id}", name="etat_produit_show", methods={"GET"})
     */
    public function show(EtatProduit $etatProduit): Response
    {
        return $this->render('etat_produit/show.html.twig', [
            'etat_produit' => $etatProduit,
        ]);
    }

    /**
     * @Route("/{etat_id}/edit", name="etat_produit_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, EtatProduit $etatProduit): Response
    {
        $form = $this->createForm(EtatProduitType::class, $etatProduit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('etat_produit_index');
        }

        return $this->render('etat_produit/edit.html.twig', [
            'etat_produit' => $etatProduit,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{etat_id}", name="etat_produit_delete", methods={"DELETE"})
     */
    public function delete(Request $request, EtatProduit $etatProduit): Response
    {
        if ($this->isCsrfTokenValid('delete'.$etatProduit->getEtat_id(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($etatProduit);
            $entityManager->flush();
        }

        return $this->redirectToRoute('etat_produit_index');
    }
}
