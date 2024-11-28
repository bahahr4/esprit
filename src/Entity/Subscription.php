<?php

namespace App\Entity;

use App\Repository\SubscriptionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SubscriptionRepository::class)]
class Subscription
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Choice(choices: ['week', 'month', 'semester'], message: 'Choose a valid subscription type.')]
    private ?string $type = null; // "week", "month", "semester"

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    #[Assert\NotBlank]
    #[Assert\Positive(message: 'The price must be a positive number.')]
    private ?float $price = null;

    #[ORM\Column(type: 'date')]
    #[Assert\NotBlank]
    private ?\DateTimeInterface $startDate = null;

    #[ORM\Column(type: 'date')]
    #[Assert\NotBlank]
    private ?\DateTimeInterface $endDate = null;

    #[ORM\ManyToOne(targetEntity: Library::class, inversedBy: 'subscriptions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Library $library = null;

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

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeInterface $endDate): self
    {
        if ($endDate <= $this->startDate) {
            throw new \InvalidArgumentException('End date must be after start date.');
        }
        $this->endDate = $endDate;

        return $this;
    }

    public function getLibrary(): ?Library
    {
        return $this->library;
    }

    public function setLibrary(?Library $library): self
    {
        $this->library = $library;

        return $this;
    }

    /**
     * Automatically calculate the end date based on the type of subscription.
     */
    public function calculateEndDate(): self
    {
        if (!$this->startDate || !$this->type) {
            throw new \LogicException('Start date and type must be set before calculating end date.');
        }

        $endDate = clone $this->startDate;

        switch ($this->type) {
            case 'week':
                $endDate->modify('+1 week');
                break;
            case 'month':
                $endDate->modify('+1 month');
                break;
            case 'semester':
                $endDate->modify('+6 months');
                break;
            default:
                throw new \InvalidArgumentException('Invalid subscription type.');
        }

        $this->setEndDate($endDate);

        return $this;
    }

    /**
     * Check if the subscription is currently active.
     */
    public function isActive(): bool
    {
        $now = new \DateTime();
        return $now >= $this->startDate && $now <= $this->endDate;
    }
}
