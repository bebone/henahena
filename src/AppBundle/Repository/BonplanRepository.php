<?php

namespace AppBundle\Repository;

use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * AnnonceRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class BonplanRepository extends \Doctrine\ORM\EntityRepository
{
    public function getUserBonsplans($user, $page, $maxPage)
    {
        if ($page < 1) {
            throw new NotFoundHttpException('La page demandée n\'existe pas');
        }

        $qb = $this->createQueryBuilder('bp')
            ->andWhere('bp.user = :user')
            ->setParameter('user', $user);

        $query = $qb->getQuery();


        $firstResult = ($page - 1) * $maxPage;
        $query->setFirstResult($firstResult)->setMaxResults($maxPage); //renvoie suelement les résultats souhaités
        $paginator = new Paginator($query);

        return $paginator;

    }


    public function getAllBonplan($page, $maxPage)
    {
        if ($page < 1) {
            throw new NotFoundHttpException('La page demandée n\'existe pas');
        }

        $qb = $this->createQueryBuilder('bp');
        $query = $qb->getQuery();


        $firstResult = ($page - 1) * $maxPage;
        $query->setFirstResult($firstResult)->setMaxResults($maxPage); //renvoie seulement les résultats souhaités
        $paginator = new Paginator($query);

        return $paginator;

    }

    public function getVingt()
    {


        $qb = $this->createQueryBuilder('bp')
            ->addOrderBy('bp.dateModif', 'DESC')
            ->setMaxResults(20);

        $query = $qb->getQuery();
        return $query->getResult();

    }

    public function getDix()
    {

        $qb = $this->createQueryBuilder('bp')
            ->addOrderBy('bp.dateModif', 'DESC')
            ->setMaxResults(10);

        $query = $qb->getQuery();
        return $query->getResult();

    }


    public function getFromAdmin()
    {

        //Affichage seulement des bons plans de l'admin
        $qb = $this->createQueryBuilder('bp')
            ->leftJoin('bp.user','u')
            ->andWhere('u.roles LIKE :roles')
            ->addOrderBy('bp.dateModif', 'DESC')
            ->setParameter('roles','%ROLE_ADMIN%');

        $query = $qb->getQuery();
        return $query->getResult();

    }



}
