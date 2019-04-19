<?php
/**
 * Created by PhpStorm.
 * User: netatlas
 * Date: 2019-03-08
 * Time: 16:55
 */

namespace App\Response;

use Hateoas\Hateoas;
use Symfony\Component\HttpFoundation\JsonResponse;

class ResourceShowResponse extends JsonResponse
{
    
    /**
     * ResourceShowResponse constructor.
     * @param $entity
     * @param Hateoas $serializer
     */
    public function __construct($entity, Hateoas $serializer)
    {
        parent::__construct(
            $serializer->serialize($entity, 'json'),
            self::HTTP_OK,
            [],
            true
        );
    }
}