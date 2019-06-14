<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\JoinExpCompetenceTechnoRepository")
 */
class JoinExpCompetenceTechno
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $ExperienceProId;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $TechnoProId;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $CompetenceProId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getExperienceProId(): ?int
    {
        return $this->ExperienceProId;
    }

    public function setExperienceProId(int $ExperienceProId): self
    {
        $this->ExperienceProId = $ExperienceProId;

        return $this;
    }

    public function getTechnoProId(): ?int
    {
        return $this->TechnoProId;
    }

    public function setTechnoProId(int $TechnoProId): self
    {
        $this->TechnoProId = $TechnoProId;

        return $this;
    }

    public function getCompetenceProId(): ?int
    {
        return $this->CompetenceProId;
    }

    public function setCompetenceProId(?int $CompetenceProId): self
    {
        $this->CompetenceProId = $CompetenceProId;

        return $this;
    }
}
