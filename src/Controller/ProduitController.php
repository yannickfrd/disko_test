<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Form\ProduitType;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
USE Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/produit")
 */
class ProduitController extends AbstractController
{
    /**
     * @Route("/", name="produit_index", methods={"GET"})
     */
    public function index(ProduitRepository $produitRepository): Response
    {
        $userId = $this->get('security.token_storage')->getToken()->getUser()->getId();

        if (!$this->isGranted('VIEW', $produitRepository->findAll())){
            return $this->render('produit/index.html.twig', [
                'produits' => $produitRepository->findAllByIdUserProd($userId),
            ]);
        }else{
            return $this->render('produit/index.html.twig', [
                'produits' => $produitRepository->findAll(),
            ]);
        }
    }

    /**
     * @Security("is_granted('ROLE_SUPER_ADMIN')")
     * @Route("/all", name="produit_all", methods={"GET"})
     */
    public function produitAll(ProduitRepository $produitRepository)
    {
        return $this->render('produit/index.html.twig', [
            'produits' => $produitRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="produit_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $produit = new Produit();
        $produit->setDatecreation(date_create('now'));
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->get('security.token_storage')->getToken()->getUser();
            $produit->setUserProd($user);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($produit);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Le produit est bien enregistré!'
            );

            return $this->redirectToRoute('produit_index');
        }

        return $this->render('produit/new.html.twig', [
            'produit' => $produit,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="produit_show_card_this", methods={"GET"})
     */
    public function showCardThis(Produit $produit): Response
    {
        return $this->render('produit/showCardThis.html.twig', [
            'produit' => $produit,
        ]);
    }

    /**
     * @Route("/{id}", name="produit_show", methods={"GET"})
     */
    public function show(Produit $produit): Response
    {
        return $this->render('produit/show.html.twig', [
            'produit' => $produit,
        ]);
    }

    /**
     * @Route("/produit_show_card", name="produit_show_card", methods={"GET"})
     */
    public function showCard(EntityManagerInterface $entityManager): Response
    {
        $produit = $entityManager->getRepository(Produit::class)->findAllByPrice();

        return $this->render('produit/showCard.html.twig', [
            'produit' => $produit,
        ]);
    }


    /**
     * @Route("/{id}/edit", name="produit_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Produit $produit): Response
    {
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash(
                'success',
                'Le produit a bien été modifier!'
            );

            return $this->redirectToRoute('produit_index', [
                'id' => $produit->getId(),
            ]);
        }

        return $this->render('produit/edit.html.twig', [
            'produit' => $produit,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="produit_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Produit $produit): Response
    {
        if ($this->isCsrfTokenValid('delete'.$produit->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($produit);
            $entityManager->flush();
        }

        $this->addFlash(
            'success',
            'Vous êtes bien été supprimé!'
        );

        return $this->redirectToRoute('produit_index');
    }
}
