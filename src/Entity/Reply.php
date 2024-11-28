<?php

namespace App\Entity;

use App\Repository\ReplyRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReplyRepository::class)]
class Reply
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'text')]
<<<<<<< HEAD
=======
    private $objet;


    public function getObjet()
    {
        return $this->objet;
    }


    public function setObjet($objet): void
    {
        $this->objet = $objet;
    }
    #[ORM\Column(type: 'text')]
>>>>>>> 273b3dc5a7dc47d103f3e51cc1635e6c06d06212
    private $content;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createdate = null;

    #[ORM\ManyToOne(inversedBy: 'replies')]
    #[ORM\JoinColumn(nullable: false)]
<<<<<<< HEAD
    private ?reclamation $reclamation = null;
=======
    private ?Reclamation $reclamation = null;
>>>>>>> 273b3dc5a7dc47d103f3e51cc1635e6c06d06212

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getCreatedate(): ?\DateTimeInterface
    {
        return $this->createdate;
    }

    public function setCreatedate(\DateTimeInterface $createdate): static
    {
        $this->createdate = $createdate;

        return $this;
    }

    public function getReclamation(): ?reclamation
    {
        return $this->reclamation;
    }

    public function setReclamation(?reclamation $reclamation): static
    {
        $this->reclamation = $reclamation;

        return $this;
    }
}
