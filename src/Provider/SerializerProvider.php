<?php
/**
 * Created by PhpStorm.
 * User: netatlas
 * Date: 2019-03-08
 * Time: 16:48
 */

namespace App\Provider;


use Hateoas\Hateoas;
use Hateoas\HateoasBuilder;
use Hateoas\UrlGenerator\SymfonyUrlGenerator;
use JMS\Serializer\SerializerBuilder;
use Symfony\Component\DependencyInjection\ContainerInterface;

class SerializerProvider
{
    /**
     * @var ContainerInterface
     */
    protected $_container;
    
    /**
     * @var string $_environment
     */
    protected $_environment;
    
    public function __construct(ContainerInterface $container)
    {
        $this->_container = $container;
        $this->_environment = $this->_container->getParameter("kernel.environment");
    }
    
    public function get() : Hateoas {
        $serializer = SerializerBuilder::create()
                ->setCacheDir($this->getCacheDir())
                ->setDebug( $this->_environment !== "prod" );
        return HateoasBuilder::create($serializer)
            ->setUrlGenerator(null, new SymfonyUrlGenerator(
                $this->_container->get("router")
            ))
            ->build();
    }
    
    protected function getCacheDir() {
        return "../var/cache/{$this->_environment}/jms_serializer";
    }
    
}