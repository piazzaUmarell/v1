<?php


namespace App\Controller\Api;

use App\Entity\Episode;
use App\Provider\SerializerProvider;
use App\Response\ResourceShowResponse;
use Doctrine\Common\Inflector\Inflector;
use Hateoas\Representation\CollectionRepresentation;
use Hateoas\Representation\PaginatedRepresentation;
use ReflectionClass;
use ReflectionException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class EpisodesController
 * @package App\Controller\Api
 * @Route("/api/episodes")
 */
class EpisodesController extends AbstractController
{
    
    /**
     * @Route("/", methods={"GET"}, name=API_ROUTE_EPISODE_INDEX)
     * @param Request $request
     * @param SerializerProvider $serializerProvider
     * @return JsonResponse
     * @throws ReflectionException
     */
    public function index(Request $request, SerializerProvider $serializerProvider) {
        $page = $request->get("page", 1);
        $items = $request->get("limit", 10);
        $filters = $request->get("filter", []);
        $filters = is_array($filters) ? $filters : [$filters];
        
        $episodesRepository = $this->getDoctrine()->getRepository(Episode::class);
        
        $entities = $episodesRepository->findLatestPaginated(
            $page,
            $items,
            $filters
        );
        
        $pages = $episodesRepository->getPagesCount($items, $filters);
    
        $resource = strtolower(
            Inflector::pluralize(
                Inflector::tableize(
                    (new ReflectionClass(Episode::class))->getShortName()
                )
            )
        );
    
        $collection =  new CollectionRepresentation(
            $entities,
            $resource
        );
    
        $paginatedCollection = new PaginatedRepresentation(
            $collection,
            API_ROUTE_EPISODE_INDEX,
            [
                'filter' => $filters
            ],
            $page,
            $items,
            $pages
        );
        
        $serializer = $serializerProvider->get();
        
        return new JsonResponse(
            $serializer->serialize(
                $paginatedCollection,
                "json"
            ),
            Response::HTTP_OK,
            [],
            ($alreadyJson = true)
        );
    }
    
    /**
     * @Route("/{episode_id}", methods={"GET"}, name=API_ROUTE_EPISODE_SHOW)
     * @param SerializerProvider $serializerProvider
     * @param Request $request
     * @return ResourceShowResponse
     */
    public function show(SerializerProvider $serializerProvider, Request $request) {
        $episode = $this->getDoctrine()
            ->getRepository(Episode::class)
            ->findOneBy(
                ['id' => $request->get("episode_id")]
            );
    
        return new ResourceShowResponse(
            $episode,
            $serializerProvider->get()
        );
    }
    
}