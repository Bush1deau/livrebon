<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\DetailsCommandeRepository;
use App\Form\StatusLivraisonType;
use App\Entity\Commande;
use App\Entity\DetailsCommande;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;

class StatusLivraisonController extends AbstractController
{
   /**
     * @Route("/commandeLivreur/{id<\d+>}", name="commandesStatus")
     */
    public function modifyStatusDeliver(Request $request, ManagerRegistry $doctrine, Commande $cmd): Response
    {       

        $form = $this->createForm(StatusLivraisonType::class, $cmd);
        $manager = $doctrine->getManager();
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
 
         $cmd = $form->getData();
 
         $manager->persist($cmd);
 
         $manager->flush();

         return $this->redirectToRoute('commandeUser', [], Response::HTTP_SEE_OTHER);

        }
 
         return $this->renderForm('livreur/status.html.twig', [
             'form' => $form,
            ]);
    
    }
}
