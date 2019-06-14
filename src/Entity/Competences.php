<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CompetencesRepository")
 */
class Competences
{
    CONST CompetencesLevel = [
        0 => 'Formation',
        1 => 'Pratique < 2 ans',
        2 => 'Confirme 2 a 5 ans',
        3 => 'Expert plus de 5 ans'
    ];
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
    private $niveau;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Categorie", inversedBy="competence")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categorie;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="competences")
     */
    private $User;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $lastCreated;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $needUpdate;

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

    public function getNiveau(): ?int
    {
        return $this->niveau;
    }

    public function setNiveau(int $niveau): self
    {
        $this->niveau = $niveau;

        return $this;
    }


    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): self
    {
        $this->User = $User;

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

    public function getNeedUpdate(): ?int
    {
        return $this->needUpdate;
    }

    public function setNeedUpdate(?int $needUpdate): self
    {
        $this->needUpdate = $needUpdate;

        return $this;
    }
}
