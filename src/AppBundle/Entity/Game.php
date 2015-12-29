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
     * @var string
     *
     * @ORM\Column(name="city", type="string", nullable=true)
     */
    private $city;

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
     * @var string
     *
     * @ORM\Column(name="game_starts_at", type="string")
     */
    private $gameStartsAt;

    /**
     * @var string
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;


    /**
     * @ORM\ManyToOne(targetEntity="Team")
     * @ORM\JoinColumn(name="first_team_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    protected $firstTeam;

    /**
     * @ORM\ManyToOne(targetEntity="Team")
     * @ORM\JoinColumn(name="second_team_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    protected $secondTeam;

    /**
     * @ORM\ManyToOne(targetEntity="TournamentGroup", inversedBy="games")
     * @ORM\JoinColumn(name="tournament_group_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    private $tournamentGroup;

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
     * @param string $gameStartsAt
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
     * @return string
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
    public function setFirstTeam(Team $firstTeam = null)
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
    public function setSecondTeam(Team $secondTeam = null)
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

    /**
     * Set city
     * @param $city
     * @return $this
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }


    /**
     * Set tournamentGroup
     *
     * @param TournamentGroup $tournamentGroup
     *
     * @return Game
     */
    public function setTournamentGroup(TournamentGroup $tournamentGroup = null)
    {
        $this->tournamentGroup = $tournamentGroup;


        return $this;
    }

    /**
     * Get tournamentGroup
     *
     * @return TournamentGroup
     */
    public function getTournamentGroup()
    {
        return $this->tournamentGroup;
    }
}
