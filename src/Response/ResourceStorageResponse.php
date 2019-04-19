<?php
/**
 * Created by PhpStorm.
 * User: netatlas
 * Date: 2019-03-08
 * Time: 09:43
 */

namespace App\Response;


use App\Resource\Abstractions\AbstractResource;
use Symfony\Component\HttpFoundation\JsonResponse;

class ResourceStorageResponse extends JsonResponse
{
    
    /**
     * ResourceCreatedResponse constructor.
     * @param AbstractResource $resource
     * @throws \ReflectionException
     */
    public function __construct(AbstractResource $resource)
    {
        parent::__construct(
            $resource->getRouteParameters(),
            self::HTTP_CREATED,
            [
                'Location' => $resource->getResourceUri()
            ],
            false
        );
    }
}