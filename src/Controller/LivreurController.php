<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request; 
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Repository\UserRepository;

class LivreurController extends AbstractController
{
    /**
     * @Route("/livreur/{id<\d+>}", name="app_livreur")
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

    

    
    
}
