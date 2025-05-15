<?php

namespace App\Controller;

use App\Entity\Location;
use App\Repository\LocationRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Messenger\Transport\Serialization\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

final class LocationController extends AbstractController
{
    public function __construct(
        private SerializerInterface $serializer
    ) {}

    #[Route('/location', name: 'location')]
    public function index(
        LocationRepository $locationRepository
    ): Response {

        $location = $locationRepository->findAll();
        // $coordinate = [
        //     45.75985,
        //     3.13153
        // ];
        $locationJson = $this->serializer->serialize(
            $location,
            'json',
            ['groups' => 'location_read']
        );
        return $this->render('location/index.html.twig', [
            'controller_name' => 'LocationController',
            'locationJson' => $locationJson
        ]);
    }
}
