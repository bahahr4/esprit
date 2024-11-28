<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
#[ORM\InheritanceType("SINGLE_TABLE")]
#[ORM\DiscriminatorColumn(name: "user_type", type: "string")]
#[ORM\DiscriminatorMap(["student" => Student::class, "professor" => Professor::class])]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "The name cannot be empty.")]
    private ?string $name = null;

    #[ORM\Column(length: 255, unique: true)]
<<<<<<< HEAD
    #[Assert\NotBlank(message: "The email cannot be empty.")]
    #[Assert\Email(message: "Please enter a valid email address.")]
=======
>>>>>>> 273b3dc5a7dc47d103f3e51cc1635e6c06d06212
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column(type: 'json',nullable: true)]
    private array $roles = [];

    public function __construct()
    {
        // Any other initialization if needed
        $this->roles = ['ROLE_USER']; // Default role can be added here if needed
    }

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

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    // Required by PasswordAuthenticatedUserInterface
    public function getSalt(): ?string
    {
        return null; // Not needed when using modern password hashers
    }

    // Required by UserInterface
    public function eraseCredentials(): void
    {
        // Clear sensitive data if necessary
    }

    public function getUserIdentifier(): string
    {
        return $this->email;

    }
}
