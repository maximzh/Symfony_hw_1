<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Team;
use AppBundle\Entity\TournamentGroup;
use Doctrine\ORM\EntityRepository;

/**
 * GameRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class GameRepository extends EntityRepository
{
    public function findGamesByGroup($id)
    {
        return $this->createQueryBuilder('g')
            ->select('g, ft, st')
            ->join('g.firstTeam','ft')
            ->join('g.secondTeam', 'st')
            ->where('g.tournamentGroup = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult();

    }

    public function findGamesByTeam(Team $team, $numberOfGames = 4)
    {

        return $this->createQueryBuilder('g')
            ->select('g, ft, st')
            ->join('g.firstTeam', 'ft')
            ->join('g.secondTeam', 'st')
            ->where('g.firstTeam = :id')
            ->orWhere('g.secondTeam = :id')
            ->setParameter('id', $team->getId())
            ->orderBy('g.gameDate', 'DESC')
            ->getQuery()
            ->setMaxResults($numberOfGames)
            ->getResult();
    }



    public function findGameWithDependencies($id)
    {
        return $this->createQueryBuilder('g')
            ->select('g , ft, st')
            ->join('g.firstTeam', 'ft')
            ->join('g.secondTeam', 'st')
            ->where('g.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
