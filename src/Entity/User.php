<?php

namespace App\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(fields="email")
 */
class User implements UserInterface, \Serializable
{

    CONST EnglishLevel = [
        0 => 'Débutant',
        1 => 'Intermédiare',
        2 => 'Avancé',
        3 => 'Expert'
    ];


    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=3)
     */
    private $Trigramme;

    /**
     * @ORM\Column(type="string", length=191, unique=true)
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;

    /**
     * @Assert\Length(max=250)
     */
    private $plainPassword;

    /**
     * The below length depends on the "algorithm" you use for encoding
     * the password, but this works well with bcrypt.
     *
     * @ORM\Column(type="string", length=64)
     */
    private $password;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    /**
     * @ORM\Column(name="roles", type="array")
     */
    private $roles = array();

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Age;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $poste;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adresse;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $expPro;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateDeNaissance;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $anglais;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Formation", mappedBy="User")
     */
    private $formations;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Competences", mappedBy="User")
     */
    private $competences;


    /**
     * @ORM\Column(type="boolean")
     */
    private $hasAccess;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $lastPDF;

    public function __construct()
    {
        $this->formations = new ArrayCollection();
        $this->competences = new ArrayCollection();
        $this->formationContinues = new ArrayCollection();
        $this->isActive = true;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTrigramme(): ?string
    {
        return $this->Trigramme;
    }

    public function setTrigramme(string $Trigramme): self
    {
        $this->Trigramme = $Trigramme;
        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;

    }

    public function updateTrigramme() {
        $trigramme = $this->prenom[0] . substr($this->nom,0,2);
        $this->Trigramme = strtoupper($trigramme);
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;
        $this-> updateTrigramme();
        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;
        $this-> updateTrigramme();
        return $this;
    }

    public function getAge(): ?int
    {
        return $this->Age;
    }

    public function setAge(int $Age): self
    {
        $this->Age = $Age;

        return $this;
    }

    public function getPoste(): ?string
    {
        return $this->poste;
    }

    public function setPoste(string $poste): self
    {
        $this->poste = $poste;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getExpPro(): ?int
    {
        return $this->expPro;
    }

    public function setExpPro(int $expPro): self
    {
        $this->expPro = $expPro;

        return $this;
    }

    public function getDateDeNaissance(): ?datetime
    {
        return $this->dateDeNaissance;
    }

    public function setDateDeNaissance(datetime $dateDeNaissance): self
    {
        $this->dateDeNaissance = $dateDeNaissance;

        return $this;
    }

    public function getAnglais(): ?string
    {
        return $this->anglais;
    }

    public function setAnglais(string $anglais): self
    {
        $this->anglais = $anglais;

        return $this;
    }

    /**
     * @return Collection|Formation[]
     */
    public function getFormations(): Collection
    {
        return $this->formations;
    }

    public function addFormation(Formation $formation): self
    {
        if (!$this->formations->contains($formation)) {
            $this->formations[] = $formation;
            $formation->setUser($this);
        }

        return $this;
    }

    public function removeFormation(Formation $formation): self
    {
        if ($this->formations->contains($formation)) {
            $this->formations->removeElement($formation);
            // set the owning side to null (unless already changed)
            if ($formation->getUser() === $this) {
                $formation->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Competences[]
     */
    public function getCompetences(): Collection
    {
        return $this->competences;
    }

    public function addCompetence(Competences $competence): self
    {
        if (!$this->competences->contains($competence)) {
            $this->competences[] = $competence;
            $competence->setUser($this);
        }

        return $this;
    }

    public function removeCompetence(Competences $competence): self
    {
        if ($this->competences->contains($competence)) {
            $this->competences->removeElement($competence);
            // set the owning side to null (unless already changed)
            if ($competence->getUser() === $this) {
                $competence->setUser(null);
            }
        }

        return $this;
    }

//    /**
//     * @return Collection|FormationContinue[]
//     */
//    public function getFormationContinues(): Collection
//    {
//        return $this->formationContinues;
//    }
//
//    public function addFormationContinue(FormationContinue $formationContinue): self
//    {
//        if (!$this->formationContinues->contains($formationContinue)) {
//            $this->formationContinues[] = $formationContinue;
//            $formationContinue->setUser($this);
//        }
//
//        return $this;
//    }
//
//    public function removeFormationContinue(FormationContinue $formationContinue): self
//    {
//        if ($this->formationContinues->contains($formationContinue)) {
//            $this->formationContinues->removeElement($formationContinue);
//            // set the owning side to null (unless already changed)
//            if ($formationContinue->getUser() === $this) {
//                $formationContinue->setUser(null);
//            }
//        }
//
//        return $this;
//    }

    /**
     * String representation of object
     * @link http://php.net/manual/en/serializable.serialize.php
     * @return string the string representation of the object or null
     * @since 5.1.0
     */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->email,
            $this->password,
            $this->isActive,
            // see section on salt below
            // $this->salt,
        ));
    }

    /**
     * Constructs the object
     * @link http://php.net/manual/en/serializable.unserialize.php
     * @param string $serialized <p>
     * The string representation of the object.
     * </p>
     * @return void
     * @since 5.1.0
     */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->email,
            $this->password,
            $this->isActive,
            // see section on salt below
            // $this->salt
            ) = unserialize($serialized);
    }

    function addRole($role) {
        $this->roles[] = $role;
    }


    /**
     * Returns the roles granted to the user.
     *
     *     public function getRoles()
     *     {
     *         return ['ROLE_USER'];
     *     }
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return (Role|string)[] The user roles
     */
    public function getRoles()
    {
        if (empty($this->roles)) {
            return ['ROLE_USER'];
        }
        return $this->roles;
    }

    /**
     * Returns the password used to authenticate the user.
     *
     * This should be the encoded password. On authentication, a plain-text
     * password will be salted, encoded, and then compared to this value.
     *
     * @return string The password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername()
    {
        return $this->email;
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * @param mixed $plainPassword
     */
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;
    }

    /**
     * @return mixed
     */
    public function getisActive()
    {
        return $this->isActive;
    }

    /**
     * @param mixed $isActive
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
    }

    /**
     * @param mixed $roles
     * @return User
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;
        return $this;
    }

    /**
     * @param mixed $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    public function getHasAccess(): ?bool
    {
        return $this->hasAccess;
    }

    public function setHasAccess(bool $hasAccess): self
    {
        $this->hasAccess = $hasAccess;

        return $this;
    }

    public function getLastPDF(): ?\DateTimeInterface
    {
        return $this->lastPDF;
    }

    public function setLastPDF(?\DateTimeInterface $lastPDF): self
    {
        $this->lastPDF = $lastPDF;

        return $this;
    }


}
