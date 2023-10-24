<?php

namespace App\Repository;

use App\Entity\Typebiere;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Typebiere>
 *
 * @method Typebiere|null find($id, $lockMode = null, $lockVersion = null)
 * @method Typebiere|null findOneBy(array $criteria, array $orderBy = null)
 * @method Typebiere[]    findAll()
 * @method Typebiere[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypebiereRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Typebiere::class);
    }

//    /**
//     * @return Typebiere[] Returns an array of Typebiere objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Typebiere
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

 /**
     * Fonction permettant de compter combien de bière il y a par couleur
     * Renvoie un tableau associatif montrant combien de bières sont associées à chaque couleur.
     *
     * @return array
     */
    public function getTypeAndArticleCount(): array
    {
        // Crée un QueryBuilder
        $querybuilder = $this->createQueryBuilder('type');

        // Construit la requête
        $querybuilder->select('type.nomType AS nom')
            ->addSelect('COUNT(article.idArticle) AS Nombre_de_bieres')
            ->leftJoin('type.articles', 'article') //le.articles correspond à la propriété dans l'entité type
            ->groupBy('type.idType')
            ->orderBy('Nombre_de_bieres', 'DESC')
            ->setMaxResults(5);
            
        // Exécute la requête et obtient les résultats
        return $querybuilder->getQuery()->getResult();
    }
}

