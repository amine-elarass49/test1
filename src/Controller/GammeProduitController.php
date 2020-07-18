<?php

namespace App\Controller;

use App\Entity\GammeProduit;
use App\Form\GammeProduitType;
use App\Repository\GammeProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/gamme/produit")
 */
class GammeProduitController extends AbstractController
{
    /**
     * @Route("/", name="gamme_produit_index", methods={"GET"})
     */
    public function index(GammeProduitRepository $gammeProduitRepository): Response
    {
        return $this->render('gamme_produit/index.html.twig', [
            'gamme_produits' => $gammeProduitRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="gamme_produit_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $gammeProduit = new GammeProduit();
        $form = $this->createForm(GammeProduitType::class, $gammeProduit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($gammeProduit);
            $entityManager->flush();

            return $this->redirectToRoute('gamme_produit_index');
        }

        return $this->render('gamme_produit/new.html.twig', [
            'gamme_produit' => $gammeProduit,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{gam_id}", name="gamme_produit_show", methods={"GET"})
     */
    public function show(GammeProduit $gammeProduit): Response
    {
        return $this->render('gamme_produit/show.html.twig', [
            'gamme_produit' => $gammeProduit,
        ]);
    }

    /**
     * @Route("/{gam_id}/edit", name="gamme_produit_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, GammeProduit $gammeProduit): Response
    {
        $form = $this->createForm(GammeProduitType::class, $gammeProduit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('gamme_produit_index');
        }

        return $this->render('gamme_produit/edit.html.twig', [
            'gamme_produit' => $gammeProduit,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{gam_id}", name="gamme_produit_delete", methods={"DELETE"})
     */
    public function delete(Request $request, GammeProduit $gammeProduit): Response
    {
        if ($this->isCsrfTokenValid('delete'.$gammeProduit->getGam_id(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($gammeProduit);
            $entityManager->flush();
        }

        return $this->redirectToRoute('gamme_produit_index');
    }
}
