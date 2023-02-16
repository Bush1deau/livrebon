<?php

namespace App\Controller;

use App\Repository\CommandeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class UserController extends AbstractController
{
    /**
     * @Route("/commandes", name="commandeUser")
     */
    public function viewCommande(CommandeRepository $commandeRepository): Response
    {
        $commande = $commandeRepository->findAll();

        return $this->render('user/commandes.html.twig', [
            'commande' => $commande
        ]);
    }
}
