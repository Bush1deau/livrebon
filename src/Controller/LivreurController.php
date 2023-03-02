<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request; 
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use App\Repository\CommandeRepository;

class LivreurController extends AbstractController
{
    /**
     * @Route("/livreur", name="app_livreur")
     * @IsGranted("ROLE_LIVREUR")
     */
    public function index(UserRepository $userRepository, Request $request): Response
    {
        
        return $this->render('livreur/index.html.twig');
    }



     /**
     * @Route("/commandes", name="commandeLivreur")
     */
    public function viewCommandelivreur(CommandeRepository $commandeRepository): Response
    {
        $commande = $commandeRepository->findAll();

        return $this->render('livreur/commandes.html.twig', [
            'commande' => $commande
        ]);
    }

    
    
}
