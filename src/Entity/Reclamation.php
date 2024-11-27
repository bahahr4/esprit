<?php

namespace App\Entity;

use App\Repository\ReclamationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ReclamationRepository::class)]
class Reclamation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Le type de réclamation ne peut pas être vide.")]
    #[Assert\Length(
        max: 255,
        maxMessage: "Le type de réclamation ne peut pas dépasser {{ limit }} caractères."
    )]
    private ?string $type = null;

    #[ORM\Column(length: 500)]
    #[Assert\NotBlank(message: "La description ne peut pas être vide.")]
    #[Assert\Length(
        min: 10,
        max: 500,
        minMessage: "La description doit contenir au moins {{ limit }} caractères.",
        maxMessage: "La description ne peut pas dépasser {{ limit }} caractères."
    )]
    private ?string $description = null;

    #[ORM\OneToMany(targetEntity: Reply::class, mappedBy: 'reclamation', cascade: ['persist', 'remove'])]
    private Collection $replies;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $daterecl = null;

    public function __construct()
    {
        $this->replies = new ArrayCollection();
        $this->daterecl = new \DateTime(); // Initialiser la date avec la date actuelle lors de la création de l'objet
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Reply>
     */
    public function getReplies(): Collection
    {
        return $this->replies;
    }

    public function addReply(Reply $reply): self
    {
        if (!$this->replies->contains($reply)) {
            $this->replies->add($reply);
            $reply->setReclamation($this);
        }

        return $this;
    }

    public function removeReply(Reply $reply): self
    {
        if ($this->replies->removeElement($reply)) {
            // set the owning side to null (unless already changed)
            if ($reply->getReclamation() === $this) {
                $reply->setReclamation(null);
            }
        }

        return $this;
    }

    public function getDaterecl(): ?\DateTimeInterface
    {
        return $this->daterecl;
    }

    public function setDaterecl(\DateTimeInterface $daterecl): static
    {
        $this->daterecl = $daterecl;

        return $this;
    }
}
