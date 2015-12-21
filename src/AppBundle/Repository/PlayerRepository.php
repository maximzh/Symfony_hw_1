<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * PlayerRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PlayerRepository extends EntityRepository
{
    public function findAllPlayersWithDependencies()
    {
        return $this->createQueryBuilder('p')
            ->select('p, t, c')
            ->join('p.team', 't')
            ->join('t.country', 'c')
            ->orderBy('p.team')
            ->getQuery()
            ->getResult();
    }
}
