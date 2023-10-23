<?php

namespace App\Repository;

use App\Entity\Continent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Continent>
 *
 * @method Continent|null find($id, $lockMode = null, $lockVersion = null)
 * @method Continent|null findOneBy(array $criteria, array $orderBy = null)
 * @method Continent[]    findAll()
 * @method Continent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContinentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Continent::class);
    }


     /**
     * Renvoie le nombre de marques de bières par continent
     *
     * @return array
     */
    public function getContinentArticleCount(): array
    {
        // Crée un QueryBuilder
        $querybuilder = $this->createQueryBuilder('c');

        // Construit la requête
        $querybuilder->select('c.nom AS Continent')
            ->addSelect('COUNT(m.id) AS Marque')
            ->innerJoin('c.pays', 'p') // suppose que l'entité Continent a une relation 'pays'
            ->innerJoin('p.marque', 'm') // suppose que l'entité Pays a une relation 'marque'
            ->groupBy('c.id')
            ->orderBy('Marque', 'DESC')
            ->setMaxResults(5);

        // Exécute la requête et obtient les résultats
        return $querybuilder->getQuery()->getResult();
    }

//    /**
//     * @return Continent[] Returns an array of Continent objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Continent
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
