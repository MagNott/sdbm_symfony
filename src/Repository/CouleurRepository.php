<?php

namespace App\Repository;

use App\Entity\Couleur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Couleur>
 *
 * @method Couleur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Couleur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Couleur[]    findAll()
 * @method Couleur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CouleurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Couleur::class);
    }





     /**
     * Fonction permettant de compter combien de bière il y a par couleur
     * Renvoie un tableau associatif montrant combien de bières sont associées à chaque couleur.
     *
     * @return array
     */
    public function getCouleurAndArticleCount(): array
    {
        // Crée un QueryBuilder
        $querybuilder = $this->createQueryBuilder('couleur');

        // Construit la requête
        $querybuilder->select('couleur.nomCouleur AS nom')
            ->addSelect('COUNT(article.idArticle) AS Nombre_de_bieres')
            ->leftJoin('couleur.articles', 'article') //le.articles correspond à la propriété dans l'entité couleur
            ->groupBy('couleur.idCouleur')
            ->orderBy('Nombre_de_bieres', 'DESC');
            
        // Exécute la requête et obtient les résultats
        return $querybuilder->getQuery()->getResult();
    }


   


//    /**
//     * @return Couleur[] Returns an array of Couleur objects
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

//    public function findOneBySomeField($value): ?Couleur
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
