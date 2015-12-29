<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Country
 *
 * @ORM\Table(name="country")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CountryRepository")
 */
class Country
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
     * @ORM\Column(name="slug", type="string", length=255, unique=true)
     */
    private $slug;

    /**
     * @var int
     *
     * @ORM\Column(name="uefa_rank", type="smallint")
     */
    private $uefaRank;

    /**
     * @var string
     *
     * @ORM\Column(name="flag", type="string", length=255, nullable=true)
     */
    private $flag;

    /**
     * @var string
     *
     * @ORM\Column(name="short_history", type="text")
     */
    private $shortHistory;

    /**
     * @var int
     *
     * @ORM\Column(name="first_membership", type="smallint", nullable=true)
     */
    private $firstMembership;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="national_team_founded_at", type="smallint", nullable=true)
     */
    private $nationalTeamFoundedAt;

    /**
     * @ORM\OneToOne(targetEntity="Team", inversedBy="country")
     * @ORM\JoinColumn(name="team_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    private $team;

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
     * @return Country
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
     * @return Country
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
     * Set uefaRank
     *
     * @param integer $uefaRank
     *
     * @return Country
     */
    public function setUefaRank($uefaRank)
    {
        $this->uefaRank = $uefaRank;

        return $this;
    }

    /**
     * Get uefaRank
     *
     * @return int
     */
    public function getUefaRank()
    {
        return $this->uefaRank;
    }

    /**
     * Set flag
     *
     * @param string $flag
     *
     * @return Country
     */
    public function setFlag($flag)
    {
        $this->flag = "/pictures/".$flag;

        return $this;
    }

    /**
     * Get flag
     *
     * @return string
     */
    public function getFlag()
    {
        return $this->flag;
    }

    /**
     * Set shortHistory
     *
     * @param string $shortHistory
     *
     * @return Country
     */
    public function setShortHistory($shortHistory)
    {
        $this->shortHistory = $shortHistory;

        return $this;
    }

    /**
     * Get shortHistory
     *
     * @return string
     */
    public function getShortHistory()
    {
        return $this->shortHistory;
    }

    /**
     * Set firstMembership
     *
     * @param integer $firstMembership
     *
     * @return Country
     */
    public function setFirstMembership($firstMembership)
    {
        $this->firstMembership = $firstMembership;

        return $this;
    }

    /**
     * Get firstMembership
     *
     * @return int
     */
    public function getFirstMembership()
    {
        return $this->firstMembership;
    }

    /**
     * Set nationalTeamFoundedAt
     *
     * @param integer $nationalTeamFoundedAt
     *
     * @return Country
     */
    public function setNationalTeamFoundedAt($nationalTeamFoundedAt)
    {
        $this->nationalTeamFoundedAt = $nationalTeamFoundedAt;

        return $this;
    }

    /**
     * Get nationalTeamFoundedAt
     *
     * @return \DateTime
     */
    public function getNationalTeamFoundedAt()
    {
        return $this->nationalTeamFoundedAt;
    }

    /**
     * Set team
     *
     * @param Team $team
     *
     * @return Country
     */
    public function setTeam(Team $team = null)
    {
        $this->team = $team;

        return $this;
    }

    /**
     * Get team
     *
     * @return Team
     */
    public function getTeam()
    {
        return $this->team;
    }
}
