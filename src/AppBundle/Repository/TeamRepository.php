<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * TeamRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TeamRepository extends EntityRepository
{
    public function findTeamWithDependencies($slug)
    {
        return $this->createQueryBuilder('t')
            ->select('t, p, c, tg, cn')
            ->join('t.players', 'p')
            ->join('t.coaches', 'c')
            ->join('t.country', 'cn')
            ->join('t.tournamentGroup','tg')
            ->where('t.slug = :slug')
            ->setParameter('slug', $slug)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findTeamsByGroup($name)
    {
        return $this->createQueryBuilder('t')
            ->select('t, p, c, tg, cn')
            ->join('t.players', 'p')
            ->join('t.country', 'cn')
            ->join('t.coaches', 'c')
            ->join('t.tournamentGroup','tg')
            ->where('tg.name = :name')
            ->setParameter('name', $name)
            ->getQuery()
            ->getResult();
    }


}
