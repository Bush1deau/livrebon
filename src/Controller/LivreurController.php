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
     * @Route("/livreur/{id<\d+>}", name="app_livreur")
     * @IsGranted("ROLE_LIVREUR")
     */
    public function index(int $id, UserRepository $userRepository, Request $request): Response
    {
        $profil = $userRepository->find($id);
        
        $session = $request->getSession();
        $session->set('user-last',$id);

        return $this->render('livreur/index.html.twig', [
            'profil' =>$profil,
        ]);
    }

     /**
     * @Route("/livcommandes", name="commandeLivreur")
     */
    public function viewCommandeLivreur(CommandeRepository $commandeRepository): Response
    {
        $commande = $commandeRepository->findAll();

        return $this->render('livreur/commandes.html.twig', [
            'commande' => $commande
        ]);
    }

    
    
}
