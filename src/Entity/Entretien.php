<?php

namespace App\Entity;

use App\Repository\EntretienRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EntretienRepository::class)]
class Entretien
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $First_name = null;

    #[ORM\Column(length: 255)]
    private ?string $Last_name = null;

    #[ORM\Column(length: 255)]
    private ?string $Email = null;

    #[ORM\Column(length: 255)]
    private ?string $CIN = null;

    #[ORM\Column(length: 255)]
    private ?string $Phone = null;

    #[ORM\Column(length: 255)]
    private ?string $French_proficiency = null;

    #[ORM\Column(length: 255)]
    private ?string $English_proficiency = null;

    #[ORM\Column(length: 255)]
    private ?string $Previous_school = null;

    #[ORM\Column(length: 255)]
    private ?string $Specialization = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->First_name;
    }

    public function setFirstName(string $First_name): static
    {
        $this->First_name = $First_name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->Last_name;
    }

    public function setLastName(string $Last_name): static
    {
        $this->Last_name = $Last_name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): static
    {
        $this->Email = $Email;

        return $this;
    }

    public function getCIN(): ?string
    {
        return $this->CIN;
    }

    public function setCIN(string $CIN): static
    {
        $this->CIN = $CIN;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->Phone;
    }

    public function setPhone(string $Phone): static
    {
        $this->Phone = $Phone;

        return $this;
    }

    public function getFrenchProficiency(): ?string
    {
        return $this->French_proficiency;
    }

    public function setFrenchProficiency(string $French_proficiency): static
    {
        $this->French_proficiency = $French_proficiency;

        return $this;
    }

    public function getEnglishProficiency(): ?string
    {
        return $this->English_proficiency;
    }

    public function setEnglishProficiency(string $English_proficiency): static
    {
        $this->English_proficiency = $English_proficiency;

        return $this;
    }

    public function getPreviousSchool(): ?string
    {
        return $this->Previous_school;
    }

    public function setPreviousSchool(string $Previous_school): static
    {
        $this->Previous_school = $Previous_school;

        return $this;
    }

    public function getSpecialization(): ?string
    {
        return $this->Specialization;
    }

    public function setSpecialization(string $Specialization): static
    {
        $this->Specialization = $Specialization;

        return $this;
    }
}
