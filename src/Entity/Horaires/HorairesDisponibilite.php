<?php

namespace App\Entity\Horaires;

use App\Entity\Reservations\ReservationsHoraires;
use App\Repository\Horaires\HorairesDisponibiliteRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HorairesDisponibiliteRepository::class)
 */
class HorairesDisponibilite
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\ManyToOne(targetEntity=HorairesJours::class, inversedBy="horairesDisponibilites")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?HorairesJours $jour;

    /**
     * @ORM\Column(type="boolean")
     */
    private ?bool $isActive;

    /**
     * @ORM\Column(type="time")
     */
    private DateTimeInterface $startAt;

    /**
     * @ORM\Column(type="time")
     */
    private DateTimeInterface $finishAt;

    /**
     * @ORM\OneToMany(targetEntity=ReservationsHoraires::class, mappedBy="horairesDisponibilites")
     */
    private $reservationsHoraires;

    public function __construct()
    {
        $this->reservationsHoraires = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJour(): ?HorairesJours
    {
        return $this->jour;
    }

    public function setJour(?HorairesJours $jour): self
    {
        $this->jour = $jour;

        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getStartAt(): DateTimeInterface
    {
        return $this->startAt;
    }

    public function setStartAt(DateTimeInterface $startAt): self
    {
        $this->startAt = $startAt;

        return $this;
    }

    public function getFinishAt(): ?DateTimeInterface
    {
        return $this->finishAt;
    }

    public function setFinishAt(DateTimeInterface $finishAt): self
    {
        $this->finishAt = $finishAt;

        return $this;
    }

    /**
     * @return Collection|ReservationsHoraires[]
     */
    public function getReservationsHoraires(): Collection
    {
        return $this->reservationsHoraires;
    }

    public function addReservationsHoraire(ReservationsHoraires $reservationsHoraire): self
    {
        if (!$this->reservationsHoraires->contains($reservationsHoraire)) {
            $this->reservationsHoraires[] = $reservationsHoraire;
            $reservationsHoraire->setHorairesDisponibilites($this);
        }

        return $this;
    }

    public function removeReservationsHoraire(ReservationsHoraires $reservationsHoraire): self
    {
        if ($this->reservationsHoraires->removeElement($reservationsHoraire)) {
            // set the owning side to null (unless already changed)
            if ($reservationsHoraire->getHorairesDisponibilites() === $this) {
                $reservationsHoraire->setHorairesDisponibilites(null);
            }
        }

        return $this;
    }

}
