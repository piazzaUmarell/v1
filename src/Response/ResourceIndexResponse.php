<?php
/**
 * Created by PhpStorm.
 * User: netatlas
 * Date: 2019-03-11
 * Time: 09:11
 */

namespace App\Response;

use Hateoas\Hateoas;
use Hateoas\Representation\CollectionRepresentation;
use Hateoas\Representation\PaginatedRepresentation;
use JMS\Serializer\Serializer;
use ReflectionClass;
use ReflectionException;
use Doctrine\Common\Inflector\Inflector;
use Symfony\Component\HttpFoundation\JsonResponse;

class ResourceIndexResponse extends JsonResponse
{
    
    /**
     * ResourceIndexResponse constructor.
     * @param string $namespacedClass
     * @param array $entities
     * @param Hateoas $serializer
     * @throws ReflectionException
     */
    public function __construct(string $namespacedClass, array $entities, Hateoas $serializer)
    {
        $resource = strtolower(
            Inflector::pluralize(
                Inflector::tableize(
                    (new ReflectionClass($namespacedClass))->getShortName()
                )
            )
        );
        
        parent::__construct(
            $serializer->serialize([], "json"),
            self::HTTP_OK,
            [],
            true
        );
    }
    
}