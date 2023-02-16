<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Entity\Livraison;
use App\Entity\DetailsCommande;
use App\Form\CommandeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CommandeRepository;
use App\Repository\DetailsCommandeRepository;
use App\Repository\LivraisonRepository;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

use Doctrine\Persistence\ManagerRegistry;

class CommandeController extends AbstractController
{
    /**
     * @Route("/commande", name="app_commande")
     */
    public function index(): Response
    {
        return $this->render('commande/index.html.twig', [
            'controller_name' => 'CommandeController',
        ]);
    }

    /**
     * @Route("/commandeAdd", name="commande_add")
     * 
     */
    public function add(Request $request, ManagerRegistry $doctrine, CommandeRepository $commandeRepository, DetailsCommandeRepository $detailsCommandeRepository, LivraisonRepository $livraisonRepository ): Response
    {
        $commande= new Commande();
        $form = $this->createForm(CommandeType::class, $commande);

        $livraison= new Livraison();

        $detailcmd= new DetailsCommande();
       
        $manager = $doctrine->getManager();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $commande = $form->getData();
            $commande->setStatus('En Attente');
            $commande->setUser($this->getUser());
            $commande->setRestaurant($form->get('repas')->getData()->getRestaurant());

            $date = $form->get('dateTime')->getData();
           
            $livraison->setDate($date);
            $livraison->setHeure($date);
            $livraison->setLieu($form->get('lieu')->getData());
            
            $livraison->setDestination($form->get('ville')->getData());
            $manager->persist($livraison);

            $commande->setLivraison($livraison);

            $manager->persist($commande);

            $detailcmd->setQuantite($form->get('quantite')->getData());
            $detailcmd->setRepas($form->get('repas')->getData());
         
            $detailcmd->setCommande($commande);
            $manager->persist($detailcmd);
            
            $manager->flush();

            return $this->redirectToRoute('commandeUser', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('commande/add.html.twig', [
            'form' => $form
        ]);
    }

    /**
     * @Route("/viewCommande", name="view_commande")
     */
    public function viewCommande(CommandeRepository $commandeRepository): Response
    {
        // $commande = $commandeRepository->findCommand();
        $commande = $commandeRepository->findAll();

        return $this->render('commande/view.html.twig', [
            'commande' => $commande
        ]);
    }
}
