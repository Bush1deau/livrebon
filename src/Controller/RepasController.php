<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\RepasType;
use App\Entity\Repas;
use App\Repository\RepasRepository;
use Doctrine\Persistence\ManagerRegistry;

class RepasController extends AbstractController
{
    /**
     * @Route("/repas", name="repas")
     */
    public function index(RepasRepository $repasRepository): Response
    {
        $repas = $repasRepository->findAll();
        return $this->render('repas/index.html.twig', [
            'repass' => $repas,
        ]);
    }

    /**
     * @Route("/repas/new", name="new-repas", methods={"GET", "POST"})
     */
    public function new(Request $request, RepasRepository $repasRepository, ManagerRegistry $doctrine): Response
    {
        $repas = new Repas();
        $form = $this->createForm(RepasType::class, $repas);
        
        $manager = $doctrine->getManager();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $repasRepository->add($repas, true);
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
     * @Route("/{id}", name="id-repas", methods={"GET"})
     */
    public function show(Repas $repas): Response
    {
        return $this->render('repas/show.html.twig', [
            'repas' => $repas,
        ]);
    }


    /**
     * @Route("/{id}/edit", name="edit_repas", methods={"GET", "POST"})
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
            'form' => $form,
        ]);
    }

}
