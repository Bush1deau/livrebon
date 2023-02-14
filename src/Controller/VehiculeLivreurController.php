<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VehiculeLivreurController extends AbstractController
{
    /**
     * @Route("/vehicule/livreur", name="app_vehicule_livreur")
     */
    public function index(): Response
    {
        return $this->render('vehicule_livreur/index.html.twig', [
            'controller_name' => 'VehiculeLivreurController',
        ]);
    }
}
