<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\DetailsCommandeRepository;
use App\Form\StatusType;
use App\Entity\Commande;
use App\Entity\DetailsCommande;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;

class StatusController extends AbstractController
{
   /**
     * @Route("/restaurant/status/{id<\d+>}", name="commandeStatus")
     */
    public function modifyStatus(Request $request, ManagerRegistry $doctrine, Commande $cmd): Response
    {       

        $form = $this->createForm(StatusType::class, $cmd);
        $manager = $doctrine->getManager();
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
 
         $cmd = $form->getData();

        
 
         $manager->persist($cmd);
 
         $manager->flush();

         return $this->redirectToRoute('restaurantCmd', [], Response::HTTP_SEE_OTHER);

        }
 
         return $this->renderForm('restaurant/status.html.twig', [
             'form' => $form,
            ]);
    
    }
}
