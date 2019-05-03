<?php
/**
 * Created by PhpStorm.
 * User: netatlas
 * Date: 2019-03-11
 * Time: 09:54
 */

namespace App\Provider;

use App\Tool\DotNotationCollection;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class FrontendRoutesProvider
{
    /**
     * @var UrlGeneratorInterface $_urlGenerator
     */
    protected $_urlGenerator;
    
    /**
     * @var ContainerInterface $_container
     */
    protected $_container;
    
    public function __construct(UrlGeneratorInterface $urlGenerator, ContainerInterface $container)
    {
        $this->_urlGenerator = $urlGenerator;
        $this->_container = $container;
    }
    
    /**
     * @return array
     */
    public function get() : array {
        return DotNotationCollection::explode([
            "episodes.index" => $this->_urlGenerator->generate(API_ROUTE_EPISODE_INDEX),
            "episodes.show" => urldecode($this->_urlGenerator->generate(API_ROUTE_EPISODE_SHOW, ["episode_id" => "{episode_id}" ])),
            "latest-episode.show" => $this->_urlGenerator->generate(API_ROUTE_LATEST_EPISODE_SHOW),
            "admin.login" => $this->_urlGenerator->generate(API_ADMIN_BACK_OFFICE_LOGIN),
            "admin.refresh" => $this->_urlGenerator->generate(API_ADMIN_BACK_OFFICE_REFRESH),
        ]);
    }
}