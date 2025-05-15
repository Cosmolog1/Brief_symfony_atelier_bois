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
    // création d'un constructeur avec serializer pour le format json concernant la communication entre aplis
    public function __construct(
        private SerializerInterface $serializer
    ) {}

    #[Route('/location', name: 'location')]
    public function index(
        LocationRepository $locationRepository
    ): Response {
        // Requete sql pour afficher toutes les infos de l'entity location
        $location = $locationRepository->findAll();
        // Transformtion en Json
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
