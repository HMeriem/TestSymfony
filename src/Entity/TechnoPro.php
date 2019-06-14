<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TechnoProRepository")
 */
class TechnoPro
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $intitule;

    /**
     * @ORM\Column(type="integer")
     */
    private $experiencePro;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $lastCreated;

    public function __construct()
    {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIntitule(): ?string
    {
        return $this->intitule;
    }

    public function setIntitule(string $intitule): self
    {
        $this->intitule = $intitule;

        return $this;
    }


    /**
     * @return int|null
     */
    public function getExperiencePro(): ?int
    {
        return $this->experiencePro;
    }

    /**
     * @param mixed $experiencePro
     */
    public function setExperiencePro($experiencePro): self
    {
        $this->experiencePro = $experiencePro;

        return $this;
    }

    public function getLastCreated(): ?\DateTimeInterface
    {
        return $this->lastCreated;
    }

    public function setLastCreated(?\DateTimeInterface $lastCreated): self
    {
        $this->lastCreated = $lastCreated;

        return $this;
    }

}
