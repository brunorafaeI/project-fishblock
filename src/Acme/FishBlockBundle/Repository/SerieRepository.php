<?php

namespace Acme\FishBlockBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * SerieRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class SerieRepository extends EntityRepository
{
    /**
     * Retourne la liste des series correspondant au genre passé en paramètre (id)
     * Si aucun genre n'est spécifié, la liste de tous les series est renvoyée.
     * @param int $idGenre Id du genre à rechercher
     * @return @AcmeFishBlockBundle/Entity/Serie[] Liste des series du genre demandé
     */
    public function findByGenre($idGenre = 0)
    {
        /* Création de la requète avec le query builder */
        $queryBuilder = $this->_em->createQueryBuilder();
        $queryBuilder->select("f, g")
            ->from("AcmeFishBlockBundle:Serie", "s")
            ->leftJoin("s.listeDesGenres", "g");

        /* Si on reçoit un id de genre valide alors on recherche les Series de ce genre là uniquement */
        if ((int)$idGenre > 0) {
            $queryBuilder->where("g.id=:idGenre")->setParameter("idGenre", (int)$idGenre);
        }
        /* Puis on retourne la liste des series du genre demandé */
        return $queryBuilder->getQuery()->getResult();
    }

    /**
     * Retourne le nombre de serie au total
     * @return int Renvoie le nombre de series total
     */
    public function countAll()
    {
        /*
         * On aurait tendance à vouloir faire un count() d'un fetchAll() sur le SerieRepository()
         * Cette solution foncitonne mais demande à doctrine de charger toutes les données en mémoire.
         * Si on a des milliers de series, doctrine va alors créer des milliers d'objets Serie dans la ram
         * ce qui n'est pas du tout optimisé.
         * 
         * En faisant un count comme ceci, aucune données n'est chargée en mémoire, une simple requête sql est 
         * lancée et le nombre est alors renvoyé.
         */

        /* Création de la requète count avec le query builder */
        $queryBuilder = $this->_em->createQueryBuilder();
        $queryBuilder->select("count(f) as total")
            ->from("AcmeFishBlockBundle:Serie", "s");

        /**
         * Comme le seul résultat qui nous intéresse est le count et pas du tout l'entité,
         * On utilise getSingleScalarResult() afin de renvoyer une valeur scalaire unique
         */
        return $queryBuilder->getQuery()->getSingleScalarResult();
    }
    
    
    
}
