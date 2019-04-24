<?php

namespace App\Repository;

use App\Entity\Episode;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Episode|null find($id, $lockMode = null, $lockVersion = null)
 * @method Episode|null findOneBy(array $criteria, array $orderBy = null)
 * @method Episode[]    findAll()
 * @method Episode[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EpisodeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Episode::class);
    }
    
    /**
     * @param int $page
     * @param int $itemsPerPage
     * @param array $filters
     * @return Episode[]
     */
    public function findLatestPaginated(int $page, int $itemsPerPage, array $filters = []): array
    {
        $page = $page < 1 ? 1 : $page;
        $itemsPerPage = $itemsPerPage < 1 ? 1 : $itemsPerPage;
        
        $query = $this->applyFilters($filters)
            ->orderBy('episode.publicationDate', 'DESC')
            ->setFirstResult(($page - 1) * $itemsPerPage)
            ->setMaxResults($itemsPerPage)
            ->getQuery();
        return $query->getResult();
    }
    
    protected function applyFilters(array $filters): QueryBuilder {
        $queryBuilder = $this->createQueryBuilder('episode')
            ->select("episode")->distinct()
            ->leftJoin("episode.categories", "category");
    
        foreach($filters as $key => $filter) {
            $filterName= ":filter$key";
            $queryBuilder->andWhere(
                "(
                    episode.title LIKE {$filterName} OR
                    episode.abstract LIKE {$filterName} OR
                    episode.description LIKE {$filterName} OR
                    category.name LIKE {$filterName}
                )"
            )->setParameter($filterName, "%$filter%");
        }
        return $queryBuilder;
    }
    
    public function getPagesCount(int $itemsPerPage, array $filters = []) {
        return ceil($this->countFiltered($filters) / $itemsPerPage);
    }
    
    protected function countFiltered(array $filters) {
        return count($this->applyFilters($filters)->select("episode.id")->distinct()->getQuery()->getScalarResult());
    }

    // /**
    //  * @return Episode[] Returns an array of Episode objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Episode
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
