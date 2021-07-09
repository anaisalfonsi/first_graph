<?php

namespace App\Entity;

use App\Repository\GradeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GradeRepository::class)
 */
class Grade
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
     * @ORM\OneToMany(targetEntity=Astronaut::class, mappedBy="grade")
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
            $astronaut->setGrade($this);
        }

        return $this;
    }

    public function removeAstronaut(Astronaut $astronaut): self
    {
        if ($this->astronauts->removeElement($astronaut)) {
            // set the owning side to null (unless already changed)
            if ($astronaut->getGrade() === $this) {
                $astronaut->setGrade(null);
            }
        }

        return $this;
    }
}
