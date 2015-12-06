<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Team;
use Doctrine\ORM\EntityRepository;

/**
 * GameRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class GameRepository extends EntityRepository
{
    public function findGamesByTeam(Team $team)
    {
        $query = $this->getEntityManager()
            ->createQuery(
                'SELECT g
                FROM AppBundle:Game g
                WHERE g.firstTeam = :id
                OR g.secondTeam = :id
                ORDER BY g.gameDate DESC
                '
            )->setParameter('id', $team->getId());
        return $query->getResult();
    }
}
