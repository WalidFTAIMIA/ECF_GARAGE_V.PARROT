<?php

namespace App\Repository;

use App\Data\SearchData;
use App\Entity\Cars;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Cars>
 */
class CarsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cars::class);
    }

    public function save(Cars $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Cars $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findSearch(SearchData $search): array
    {
        $query = $this->getSearchQuery($search)->getQuery();

        return $query->getResult();
    }

    /**
     * Récupère le prix min et le prix max , le kilométrage min et max et année min et max en fonction des filtres de recherche
     *
     * @param SearchData $search
     * @return integer[]
     */
    public function findMinMax(SearchData $search): array
    {
        $results = $this->getSearchQuery($search, true, true)
            ->select('MIN(cars.carsPrice) as prixmin', 'MAX(cars.carsPrice) as prixmax',
                     'MIN(cars.carsKm) as kmmin', 'MAX(cars.carsKm) as kmmax', 
                     'MIN(cars.carsYear) as yearmin', 'MAX(cars.carsYear) as yearmax')

            ->getQuery()
            ->getScalarResult();

        return [
            $results[0]['prixmin'] ?: 0,
            $results[0]['prixmax'] ?: 0,
            $results[0]['kmmin'] ?: 0,
            $results[0]['kmmax'] ?: 0,
            $results[0]['yearmin'] ?: 0,
            $results[0]['yearmax'] ?: 0,
        ];
    }
    
    /**
     * Construit la requête de recherche en fonction des filtres
     *
     * @param SearchData $search
     * @param bool $ignorePrice
     * @param bool $ignoreKm
     *  @param bool $ignoreYear
     * @return QueryBuilder
     */
    private function getSearchQuery(SearchData $search, $ignorePrice = false, $ignoreKm = false, $ignoreYear = false): QueryBuilder
    {
        $qb = $this->createQueryBuilder('cars');
    
        if (!empty($search->prixmin) && !$ignorePrice) {
            $qb = $qb
                ->andWhere('cars.carsPrice >= :prixmin')
                ->setParameter('prixmin', $search->prixmin);
        }
    
        if (!empty($search->prixmax) && !$ignorePrice) {
            $qb = $qb
                ->andWhere('cars.carsPrice <= :prixmax')
                ->setParameter('prixmax', $search->prixmax);
        }
        if (!empty($search->kmmin) && !$ignoreKm) {
            $qb = $qb
                ->andWhere('cars.carsKm >= :kmmin')
                ->setParameter('kmmin', $search->kmmin);
        }
    
        if (!empty($search->kmmax) && !$ignoreKm) {
            $qb = $qb
                ->andWhere('cars.carsKm <= :kmmax')
                ->setParameter('kmmax', $search->kmmax);
        }
        
        if (!empty($search->yearmin) && !$ignoreYear) {
            $qb = $qb
                ->andWhere('cars.carsYear >= :yearmin')
                ->setParameter('yearmin', $search->yearmin);
        }
    
        if (!empty($search->yearmax) && !$ignoreYear) {
            $qb = $qb
                ->andWhere('cars.carsYear <= :yearmax')
                ->setParameter('yearmax', $search->yearmax);
        }
        return $qb;
    }
}
