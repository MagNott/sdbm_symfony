<?php

namespace App\Repository;

use App\Entity\Fabricant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Fabricant>
 *
 * @method Fabricant|null find($id, $lockMode = null, $lockVersion = null)
 * @method Fabricant|null findOneBy(array $criteria, array $orderBy = null)
 * @method Fabricant[]    findAll()
 * @method Fabricant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FabricantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Fabricant::class);
    }

 /**
     * Fonction pour savoir quel est le top 5 des fabricants qui ont le plus de bière
     * Renvoie le top 5 des fabricants ayant le plus grand nombre de bières.
     *
     * @return array
     */
    public function getFabricantArticleCount(): array
    {
        // Crée un QueryBuilder
        $querybuilder = $this->createQueryBuilder('fabricant');

        // Construit la requête
        $querybuilder->select('fabricant.nomFabricant AS nom')
            ->addSelect('COUNT(article.idArticle) AS Nombre_de_bieres')
            ->innerJoin('fabricant.marques', 'marque') 
            ->innerJoin('marque.articles', 'article') 
            ->groupBy('fabricant.idFabricant')
            ->orderBy('Nombre_de_bieres', 'DESC')
            ->setMaxResults(5);

        // Exécute la requête et obtient les résultats
        return $querybuilder->getQuery()->getResult();
    }



//    /**
//     * @return Fabricant[] Returns an array of Fabricant objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('f.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Fabricant
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
