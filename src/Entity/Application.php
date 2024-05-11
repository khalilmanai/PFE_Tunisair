<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]

class Application
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'blob', nullable: true)]
    private $cvFile;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $etablissement = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $diplome = null;

    #[ORM\Column(type: 'blob', nullable: true)]
    private $motivationLetter;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id')]
    private ?User $user;
    // Getters and setters...

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setCvFile($cvFile)
    {
        $this->cvFile = $cvFile;
        return $this;
    }

    public function getCvFile()
    {
        return $this->cvFile;
    }

    public function setEtablissement(?string $etablissement): self
    {
        $this->etablissement = $etablissement;
        return $this;
    }

    public function getEtablissement(): ?string
    {
        return $this->etablissement;
    }

    public function setDiplome(?string $diplome): self
    {
        $this->diplome = $diplome;
        return $this;
    }

    public function getDiplome(): ?string
    {
        return $this->diplome;
    }

    public function setMotivationLetter($motivationLetter)
    {
        $this->motivationLetter = $motivationLetter;
        return $this;
    }

    public function getMotivationLetter()
    {
        return $this->motivationLetter;
    }

    public function setUser(?User $user): void
    {
        $this->user = $user;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }
}
