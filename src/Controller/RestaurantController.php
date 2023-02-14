<?php

namespace App\Controller;

use App\Entity\Restaurant;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\RestaurantRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Form\RestaurantType;
use Doctrine\Persistence\ManagerRegistry;

class RestaurantController extends AbstractController
{
    /**
     * @Route("/restaurant", name="restaurant", methods={"GET"})
     */
    public function index(RestaurantRepository $restaurantRepository): Response
    {
        $restaurants = $restaurantRepository->findAll();
        return $this->render('restaurant/index.html.twig', [
            'restaurants' => $restaurants,
        ]);
    }


    /**
     * @Route("/restaurant/new", name="new-restaurant", methods={"GET", "POST"})
     */
    public function new(Request $request, RestaurantRepository $restaurantRepository, ManagerRegistry $doctrine): Response
    {
        $restaurant = new Restaurant();
        $form = $this->createForm(RestaurantType::class, $restaurant);
        
        $manager = $doctrine->getManager();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $restaurantRepository->add($restaurant, true);
            $restaurant = $form->getData();
            $manager->persist($restaurant);
            $manager->flush();

            return $this->redirectToRoute('restaurant', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('restaurant/new.html.twig', [
            'form' => $form,
        ]);
    }

    /**
     * @Route("restaurant/{id}", name="id-restaurant", methods={"GET"})
     */
    public function show(Restaurant $restaurant): Response
    {
        return $this->render('restaurant/show.html.twig', [
            'restaurant' => $restaurant,
        ]);
    }


    /**
     * @Route("restaurant/{id}/edit", name="edit_restaurant", methods={"GET", "POST"})
     */
    public function edit(Request $request, Restaurant $restaurant, RestaurantRepository $restaurantRepository): Response
    {
        $form = $this->createForm(RestaurantType::class, $restaurant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $restaurantRepository->add($restaurant, true);

            return $this->redirectToRoute('restaurant', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('restaurant/edit.html.twig', [
            'restaurant' => $restaurant,
            'form' => $form,
        ]);
    }


}
