<?php


namespace App\Controller\Api;

use ReflectionClass;
use App\Entity\Episode;
use ReflectionException;
use App\Provider\SerializerProvider;
use App\Response\ResourceShowResponse;
use Doctrine\Common\Inflector\Inflector;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Hateoas\Representation\PaginatedRepresentation;
use Hateoas\Representation\CollectionRepresentation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class EpisodesController
 * @package App\Controller\Api
 * @Route("/api/latest-episode")
 */
class LatestEpisodeController extends AbstractController
{
    
    /**
     * @Route("/", methods={"GET"}, name=API_ROUTE_LATEST_EPISODE_SHOW)
     * @param SerializerProvider $serializerProvider
     * @param Request $request
     * @return ResourceShowResponse
     */
    public function show(SerializerProvider $serializerProvider, Request $request) {
        $episode = $this->getDoctrine()
            ->getRepository(Episode::class)
            ->findLatest();
        
        return new ResourceShowResponse(
            $episode,
            $serializerProvider->get()
        );
    }
    
}