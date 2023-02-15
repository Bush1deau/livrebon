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
     * @Route("/commandeAdd", name="app_commande_add")
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
            $commande->setStatus(['enAttente']);
            $commande->setUser($this->getUser());

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
        }


        //  on recupere le repas > resto
        // on cree le detail commande 
        // cree un objet livraison > date , heure, lieu , 


        return $this->renderForm('commande/add.html.twig', [
            'form' => $form
        ]);
    }
}
