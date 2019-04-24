<?php


namespace App\Provider;


use App\Entity\Episode;
use App\Tool\DotNotationCollection;
use Doctrine\ORM\EntityManagerInterface;

class FrontendGlobalsProvider
{
    /**
     * @var EntityManagerInterface $_entityManager;
     */
    protected $_entityManager;
    
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->_entityManager = $entityManager;
    }
    
    
    public function get() {
        return DotNotationCollection::explode([
            // "episodes.cardinality" => $this->getEpisodesCardinality()
        ]);
    }
    
    public function getEpisodesCardinality(): int {
        return $this->_entityManager->createQueryBuilder()
            ->select("COUNT(episode.id)")
            ->from(Episode::class, "episode")
            ->getQuery()
            ->getSingleScalarResult()
            ;
    }
    
}