<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Game
 *
 * @ORM\Table(name="game")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GameRepository")
 */
class Game
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
     * @var int
     *
     * @ORM\Column(name="first_team_score", type="smallint", nullable=true)
     */
    private $firstTeamScore;

    /**
     * @var int
     *
     * @ORM\Column(name="second_team_score", type="smallint", nullable=true)
     */
    private $secondTeamScore;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="game_date", type="date")
     */
    private $gameDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="game_starts_at", type="time")
     */
    private $gameStartsAt;

    /**
     * @ORM\ManyToOne(targetEntity="Team")
     * @ORM\JoinColumn(name="first_team_id", referencedColumnName="id")
     */
    protected $firstTeam;

    /**
     * @ORM\ManyToOne(targetEntity="Team")
     * @ORM\JoinColumn(name="second_team_id", referencedColumnName="id")
     */
    protected $secondTeam;


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
     * Set firstTeamScore
     *
     * @param integer $firstTeamScore
     *
     * @return Game
     */
    public function setFirstTeamScore($firstTeamScore)
    {
        $this->firstTeamScore = $firstTeamScore;

        return $this;
    }

    /**
     * Get firstTeamScore
     *
     * @return int
     */
    public function getFirstTeamScore()
    {
        return $this->firstTeamScore;
    }

    /**
     * Set secondTeamScore
     *
     * @param integer $secondTeamScore
     *
     * @return Game
     */
    public function setSecondTeamScore($secondTeamScore)
    {
        $this->secondTeamScore = $secondTeamScore;

        return $this;
    }

    /**
     * Get secondTeamScore
     *
     * @return int
     */
    public function getSecondTeamScore()
    {
        return $this->secondTeamScore;
    }

    /**
     * Set gameDate
     *
     * @param \DateTime $gameDate
     *
     * @return Game
     */
    public function setGameDate($gameDate)
    {
        $this->gameDate = $gameDate;

        return $this;
    }

    /**
     * Get gameDate
     *
     * @return \DateTime
     */
    public function getGameDate()
    {
        return $this->gameDate;
    }

    /**
     * Set gameStartsAt
     *
     * @param \DateTime $gameStartsAt
     *
     * @return Game
     */
    public function setGameStartsAt($gameStartsAt)
    {
        $this->gameStartsAt = $gameStartsAt;

        return $this;
    }

    /**
     * Get gameStartsAt
     *
     * @return \DateTime
     */
    public function getGameStartsAt()
    {
        return $this->gameStartsAt;
    }

    /**
     * Set firstTeam
     *
     * @param \AppBundle\Entity\Team $firstTeam
     *
     * @return Game
     */
    public function setFirstTeam(\AppBundle\Entity\Team $firstTeam = null)
    {
        $this->firstTeam = $firstTeam;

        return $this;
    }

    /**
     * Get firstTeam
     *
     * @return \AppBundle\Entity\Team
     */
    public function getFirstTeam()
    {
        return $this->firstTeam;
    }

    /**
     * Set secondTeam
     *
     * @param \AppBundle\Entity\Team $secondTeam
     *
     * @return Game
     */
    public function setSecondTeam(\AppBundle\Entity\Team $secondTeam = null)
    {
        $this->secondTeam = $secondTeam;

        return $this;
    }

    /**
     * Get secondTeam
     *
     * @return \AppBundle\Entity\Team
     */
    public function getSecondTeam()
    {
        return $this->secondTeam;
    }
}