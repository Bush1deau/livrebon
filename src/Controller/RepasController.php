<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\RepasType;
use App\Entity\Repas;
use App\Entity\Restaurant;
use App\Repository\RepasRepository;
use Doctrine\Persistence\ManagerRegistry;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class RepasController extends AbstractController
{
    /**
     * @Route("/repass", name="repas")
     * @IsGranted("ROLE_RESTAURATEUR")
     */
    public function index(RepasRepository $repasRepository): Response
    {
        $repas = $repasRepository->findAll();
        return $this->render('repas/index.html.twig', [
            'repass' => $repas,
        ]);
    }

    /**
     * @Route("/repasResto/{id}", name="repasResto", methods={"GET", "POST"})
     * @IsGranted("ROLE_RESTAURATEUR")
     */
    public function view(Restaurant $restaurant): Response
    {
        return $this->render('repas/index.html.twig', [
            'restaurant' => $restaurant,
        ]);
    }

    /**
     * @Route("/repas/new", name="new-repas", methods={"GET", "POST"})
     * @IsGranted("ROLE_RESTAURATEUR")
     */
    public function new(Request $request, RepasRepository $repasRepository, ManagerRegistry $doctrine): Response
    {
        $repas = new Repas();
        $form = $this->createForm(RepasType::class, $repas);
        
        $manager = $doctrine->getManager();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $repasRepository->add($repas, true);

            $repas->setRestaurant($this->getUser()->getRestaurant());
            
            $repas = $form->getData();

            $manager->persist($repas);
            $manager->flush();

            return $this->redirectToRoute('repas', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('repas/new.html.twig', [
            'form' => $form,
        ]);
    }

    /**
     * @Route("repas/{id}", name="id-repas", methods={"GET"})
     * @IsGranted("ROLE_RESTAURATEUR")
     */
    public function show(Repas $repas): Response
    {
        return $this->render('repas/show.html.twig', [
            'repas' => $repas,
        ]);
    }


    /**
     * @Route("repas/{id}/edit", name="edit_repas", methods={"GET", "POST"})
     * @IsGranted("ROLE_RESTAURATEUR")
     */
    public function edit(Request $request, Repas $repas, RepasRepository $repasRepository): Response
    {
        $form = $this->createForm(RepasType::class, $repas);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $repasRepository->add($repas, true);

            return $this->redirectToRoute('repas', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('repas/edit.html.twig', [
            'repas' => $repas,
            'form' => $form,
        ]);
    }

    /**
     * @Route("repas/{id}", name="delete_repas", methods={"POST"})
     * @IsGranted("ROLE_RESTAURATEUR")
     */
    public function delete(Request $request, Repas $repas, RepasRepository $repasRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$repas->getId(), $request->request->get('_token'))) {
            $repasRepository->remove($repas, true);
        }

        return $this->redirectToRoute('repas', [], Response::HTTP_SEE_OTHER);
    }

}
