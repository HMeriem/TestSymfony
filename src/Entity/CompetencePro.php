<?php

namespace App\Entity;


use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Collection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CompetenceProRepository")
 */
class CompetencePro
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     * @Assert\NotBlank(
     *     message = "Mets une valeur !"
     * )
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

    public function getExperiencePro(): ?int
    {
        return $this->experiencePro;
    }

    public function setExperiencePro(int $experiencePro): self
    {
        $this->experiencePro = $experiencePro;

        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getLastCreated(): DateTimeInterface
    {
        return $this->lastCreated;
    }

    public function setLastCreated(DateTimeInterface $lastCreated): self
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
