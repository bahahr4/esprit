<?php

namespace App\Entity;

use App\Repository\ProfessorRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProfessorRepository::class)]
class Professor
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $idprof = null;

    #[ORM\Column]
    private ?int $PhoneNumberProf = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getIdprof(): ?string
    {
        return $this->idprof;
    }

    public function setIdprof(string $idprof): static
    {
        $this->idprof = $idprof;

        return $this;
    }

    public function getPhoneNumberProf(): ?int
    {
        return $this->PhoneNumberProf;
    }

    public function setPhoneNumberProf(int $PhoneNumberProf): static
    {
        $this->PhoneNumberProf = $PhoneNumberProf;

        return $this;
    }
}
