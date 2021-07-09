<?php

namespace App\Entity;

use App\Repository\PlanetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlanetRepository::class)
 */
class Planet
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity=Astronaut::class)
     */
    private $astronauts;

    public function __construct()
    {
        $this->astronauts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Astronaut[]
     */
    public function getAstronauts(): Collection
    {
        return $this->astronauts;
    }

    public function addAstronaut(Astronaut $astronaut): self
    {
        if (!$this->astronauts->contains($astronaut)) {
            $this->astronauts[] = $astronaut;
        }

        return $this;
    }

    public function removeAstronaut(Astronaut $astronaut): self
    {
        $this->astronauts->removeElement($astronaut);

        return $this;
    }
}
