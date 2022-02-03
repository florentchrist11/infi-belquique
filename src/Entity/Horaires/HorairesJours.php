<?php

namespace App\Entity\Horaires;

use App\Repository\Horaires\HorairesJoursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HorairesJoursRepository::class)
 */
class HorairesJours
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $designation;

    /**
     * @ORM\OneToMany(targetEntity=HorairesDisponibilite::class, mappedBy="jour")
     */
    private Collection $horairesDisponibilites;

    public function __construct()
    {
        $this->horairesDisponibilites = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(string $designation): self
    {
        $this->designation = $designation;

        return $this;
    }

    /**
     * @return Collection|HorairesDisponibilite[]
     */
    public function getHorairesDisponibilites(): Collection
    {
        return $this->horairesDisponibilites;
    }

    public function addHorairesDisponibilite(HorairesDisponibilite $horairesDisponibilite): self
    {
        if (!$this->horairesDisponibilites->contains($horairesDisponibilite)) {
            $this->horairesDisponibilites[] = $horairesDisponibilite;
            $horairesDisponibilite->setJour($this);
        }

        return $this;
    }

    public function removeHorairesDisponibilite(HorairesDisponibilite $horairesDisponibilite): self
    {
        if ($this->horairesDisponibilites->removeElement($horairesDisponibilite)) {
            // set the owning side to null (unless already changed)
            if ($horairesDisponibilite->getJour() === $this) {
                $horairesDisponibilite->setJour(null);
            }
        }

        return $this;
    }
}
