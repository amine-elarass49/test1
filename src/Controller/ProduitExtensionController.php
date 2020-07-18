<?php

namespace App\Controller;

use App\Entity\ProduitExtension;
use App\Form\ProduitExtensionType;
use App\Repository\ProduitExtensionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/produit/extension")
 */
class ProduitExtensionController extends AbstractController
{
    /**
     * @Route("/", name="produit_extension_index", methods={"GET"})
     */
    public function index(ProduitExtensionRepository $produitExtensionRepository): Response
    {
        return $this->render('produit_extension/index.html.twig', [
            'produit_extensions' => $produitExtensionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="produit_extension_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $produitExtension = new ProduitExtension();
        $form = $this->createForm(ProduitExtensionType::class, $produitExtension);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($produitExtension);
            $entityManager->flush();

            return $this->redirectToRoute('produit_extension_index');
        }

        return $this->render('produit_extension/new.html.twig', [
            'produit_extension' => $produitExtension,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{pr_ex_id}", name="produit_extension_show", methods={"GET"})
     */
    public function show(ProduitExtension $produitExtension): Response
    {
        return $this->render('produit_extension/show.html.twig', [
            'produit_extension' => $produitExtension,
        ]);
    }

    /**
     * @Route("/{pr_ex_id}/edit", name="produit_extension_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ProduitExtension $produitExtension): Response
    {
        $form = $this->createForm(ProduitExtensionType::class, $produitExtension);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('produit_extension_index');
        }

        return $this->render('produit_extension/edit.html.twig', [
            'produit_extension' => $produitExtension,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{pr_ex_id}", name="produit_extension_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ProduitExtension $produitExtension): Response
    {
        if ($this->isCsrfTokenValid('delete'.$produitExtension->getPr_ex_id(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($produitExtension);
            $entityManager->flush();
        }

        return $this->redirectToRoute('produit_extension_index');
    }
}
