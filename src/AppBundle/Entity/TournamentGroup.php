<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Game;
use AppBundle\Entity\Team;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * TournamentGroup
 *
 * @ORM\Table(name="tournament_group")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TournamentGroupRepository")
 */
class TournamentGroup
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="Team", mappedBy="tournamentGroup")
     *
     */
    private $teams;

    /**
     * @ORM\OneToMany(targetEntity="Game", mappedBy="tournamentGroup")
     */
    private $games;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return TournamentGroup
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->teams = new ArrayCollection();
        $this->games = new ArrayCollection();
    }

    /**
     * Add team
     *
     * @param Team $team
     *
     * @return TournamentGroup
     */
    public function addTeam(Team $team)
    {
        $this->teams[] = $team;

        $team->setTournamentGroup($this);

        return $this;
    }

    /**
     * Remove team
     *
     * @param Team $team
     */
    public function removeTeam(Team $team)
    {
        $this->teams->removeElement($team);
    }

    /**
     * Get teams
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTeams()
    {
        return $this->teams;
    }

    /**
     * Add game
     *
     * @param Game $game
     *
     * @return TournamentGroup
     */
    public function addGame(Game $game)
    {
        $this->games[] = $game;

        $game->setTournamentGroup($this);

        return $this;
    }

    /**
     * Remove game
     *
     * @param Game $game
     */
    public function removeGame(Game $game)
    {
        $this->games->removeElement($game);
    }

    /**
     * Get games
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGames()
    {
        return $this->games;
    }
}
