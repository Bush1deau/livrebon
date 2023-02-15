<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Entity\DetailsCommande;
use App\Entity\Repas;
use App\Repository\RepasRepository;
use App\Repository\CommandeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/commandes", name="commandeUser")
     */
    public function index(RepasRepository $repasRepository , CommandeRepository $commandeRepository): Response
    {
        $commande = new Commande();
        $detailcmd= new DetailsCommande();
        $repas =new Repas();




        
        $quantite = $detailcmd->getQuantite();
        $tarif = $repas->getTarif();





        $prixFinal = intval($tarif) * floatval($quantite);
        return $this->render('user/commandes.html.twig', [
            'prixFinal' => $prixFinal,
        ]);
    }
}
