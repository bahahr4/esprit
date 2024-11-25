<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
class Professor extends User
{
    #[ORM\Column]
    private ?string $phoneNumberProf = null;

    public function getPhoneNumberProf(): ?string
    {
        return $this->phoneNumberProf;
    }

    public function setPhoneNumberProf(string $phoneNumberProf): static
    {
        $this->phoneNumberProf = $phoneNumberProf;

        return $this;
    }
}
