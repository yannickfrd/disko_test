<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Form\ProduitType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MySpaceController extends AbstractController
{
    /**
     * @Route("/monEspace", name="my_space")
     */
    public function index()
    {
        return $this->render('my_space/index.html.twig', [
            'controller_name' => 'MySpaceController',
        ]);
    }

    /**
     * @Route("/newProduit", name="new_produit")
     */
    public function newProduit(Request $request, ObjectManager $manager)
    {
        $produit = new Produit();
        $produit->setDatecreation(date_create('now'));
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $userSession = $this->get('security.token_storage')->getToken()->getUser();
            $produit->setUserProd($userSession);
            $manager->persist($produit);
            $manager->flush();
        }

        return $this->render('my_space/new.html.twig', [
            'controller_name' => 'MySpaceController',
            'form' => $form->createView()
        ]);
    }

}
