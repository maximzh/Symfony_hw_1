<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Coach;
use AppBundle\Entity\Player;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;


/**
 * Team
 *
 * @ORM\Table(name="team")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TeamRepository")
 */
class Team
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
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255, unique=false)
     */
    private $slug;

    /**
     * @ORM\OneToMany(targetEntity="Player", mappedBy="team")
     */
    protected $players;

    /**
     * @ORM\OneToMany(targetEntity="Coach", mappedBy="team")
     */
    protected $coaches;

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
     * @return Team
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
     * Set slug
     *
     * @param string $slug
     *
     * @return Team
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->players = new ArrayCollection();
        $this->coaches = new ArrayCollection();
    }

    /**
     * Add player
     *
     * @param Player $player
     *
     * @return Team
     */
    public function addPlayer(Player $player)
    {
        $this->players[] = $player;

        $player->setTeam($this);

        return $this;
    }

    /**
     * Remove player
     *
     * @param Player $player
     */
    public function removePlayer(Player $player)
    {
        $this->players->removeElement($player);
    }

    /**
     * Get players
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPlayers()
    {
        return $this->players;
    }

    /**
     * Add coach
     *
     * @param Coach $coach
     *
     * @return Team
     */
    public function addCoach(Coach $coach)
    {
        $this->coaches[] = $coach;

        return $this;
    }

    /**
     * Remove coach
     *
     * @param Coach $coach
     */
    public function removeCoach(Coach $coach)
    {
        $this->coaches->removeElement($coach);
    }

    /**
     * Get coaches
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCoaches()
    {
        return $this->coaches;
    }
}
