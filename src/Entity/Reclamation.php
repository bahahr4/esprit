<?php

namespace App\Entity;

use App\Repository\ReclamationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReclamationRepository::class)]
class Reclamation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column(type: Types::TEXT)]  // Changement de 'string' à 'text' pour le contenu
    private ?string $description = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $datereclamation = null;

    #[ORM\OneToMany(mappedBy: 'reclamation', targetEntity: Reply::class, cascade: ["persist", "remove"])]
    private Collection $replies;

    public function __construct()
    {
        $this->replies = new ArrayCollection();
    }

    // Getters and Setters

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getDatereclamation(): ?\DateTimeInterface
    {
        return $this->datereclamation;
    }

    public function setDatereclamation(\DateTimeInterface $datereclamation): static
    {
        $this->datereclamation = $datereclamation;

        return $this;
    }

    /**
     * @return Collection<int, Reply>
     */
    public function getReplies(): Collection
    {
        return $this->replies;
    }

    public function addReply(Reply $reply): static
    {
        if (!$this->replies->contains($reply)) {
            $this->replies->add($reply);
            $reply->setReclamation($this); // Assurez-vous que la relation est correctement définie des deux côtés
        }

        return $this;
    }

    public function removeReply(Reply $reply): static
    {
        if ($this->replies->removeElement($reply)) {
            // Set the owning side to null (unless already changed)
            if ($reply->getReclamation() === $this) {
                $reply->setReclamation(null);
            }
        }

        return $this;
    }
}
