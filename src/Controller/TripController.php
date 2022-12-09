<?php

namespace App\Controller;

use App\Entity\Trip;
use App\Form\TripType;
use App\Repository\TripRepository;
use App\Service\GeoService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/trip", name="trip_")
 */
class TripController extends AbstractController
{
    /**
     * @Route("/", name="index", methods={"GET"})
     */
    public function index(TripRepository $tripRepository): Response
    {
        return $this->render('trip/index.html.twig', [
            'trips' => $tripRepository->findAll()
        ]);
    }

    /**
     * @Route("/new", name="new", methods={"GET","POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager, GeoService $geoService): Response
    {
        $trip = new Trip();
        $form = $this->createForm(TripType::class, $trip);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $distance = $geoService->calculateDistance(
                $trip->getFromCity()->getLatitude(),
                $trip->getFromCity()->getLongitude(),
                $trip->getToCity()->getLatitude(),
                $trip->getToCity()->getLongitude()
            );
            $trip->setDistance($distance);
            $entityManager->persist($trip);
            $entityManager->flush();
            return $this->redirectToRoute('trip_index');
        }
        return $this->render('trip/new.html.twig', [
            'trip' => $trip,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}", name="show", methods={"GET"})
     */
    public function show(Trip $trip): Response
    {
        return $this->render('trip/show.html.twig', [
            'trip' => $trip
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Trip $trip, GeoService $geoService): Response
    {
        $form = $this->createForm(TripType::class, $trip);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $distance = $geoService->calculateDistance(
                $trip->getFromCity()->getLatitude(),
                $trip->getFromCity()->getLongitude(),
                $trip->getToCity()->getLatitude(),
                $trip->getToCity()->getLongitude()
            );
        $trip->setDistance($distance);
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('trip_index');
        }
        return $this->render('trip/edit.html.twig', [
            'trip' => $trip,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}", name="delete", methods={"delete"})
     */
    public function delete(Request $request, Trip $trip): Response
    {
        if ($this->isCsrfTokenValid('delete'.$trip->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($trip);
            $entityManager->flush();
        }
        return $this->redirectToRoute('trip_index');
    }
}
