<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * CountryRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 *
 */
class CountryRepository extends EntityRepository
{
    public function findAllCountriesWithDependencies()
    {
        return $this->createQueryBuilder('c')
            ->select('c, t, tg')
            ->leftJoin('c.team', 't')
            ->leftJoin('t.tournamentGroup', 'tg')
            ->orderBy('c.uefaRank')
            ->getQuery()
            ->getResult();

    }
}
