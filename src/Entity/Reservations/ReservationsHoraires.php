<?php

namespace App\Entity\Reservations;

use App\Entity\Horaires\HorairesDisponibilite;
use App\Repository\Reservations\ReservationsHorairesRepository;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ReservationsHorairesRepository::class)
 */
class ReservationsHoraires
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"read:reservation", "read:horaires"})
     */
    private ?int $id;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Groups({"read:reservation", "read:horaires"})
     */
    private ?DateTimeInterface $otherDate;

    /**
     * @ORM\ManyToOne(targetEntity=Reservations::class, inversedBy="reservationsHoraires")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?Reservations $reservation;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * @Groups({"read:reservation", "read:horaires"})
     */
    private ?bool $statut;

    /**
     * @ORM\ManyToOne(targetEntity=HorairesDisponibilite::class, inversedBy="reservationsHoraires")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?HorairesDisponibilite $horairesDisponibilites;

    /**
     * @ORM\Column(type="time")
     * @Groups({"read:reservation", "read:horaires"})
     */
    private ?\DateTimeInterface $startAt;

    /**
     * @ORM\Column(type="time")
     * @Groups({"read:reservation", "read:horaires"})
     */
    private ?\DateTimeInterface $finishAt;

    /**
     * @ORM\Column(type="date")
     * @Groups({"read:reservation", "read:horaires"})
     */
    private ?\DateTimeInterface $date;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReservation(): ?Reservations
    {
        return $this->reservation;
    }

    public function setReservation(?Reservations $reservation): self
    {
        $this->reservation = $reservation;

        return $this;
    }

    public function getHorairesDisponibilites(): ?HorairesDisponibilite
    {
        return $this->horairesDisponibilites;
    }

    public function setHorairesDisponibilites(?HorairesDisponibilite $horairesDisponibilites): self
    {
        $this->horairesDisponibilites = $horairesDisponibilites;

        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getOtherDate(): ?DateTimeInterface
    {
        return $this->otherDate;
    }

    /**
     * @param DateTimeInterface|null $otherDate
     * @return ReservationsHoraires
     */
    public function setOtherDate(?DateTimeInterface $otherDate): self
    {
        $this->otherDate = $otherDate;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getStatut(): ?bool
    {
        return $this->statut;
    }

    /**
     * @param bool|null $statut
     * @return ReservationsHoraires
     */
    public function setStatut(?bool $statut): self
    {
        $this->statut = $statut;
        return $this;
    }

    public function getStartAt(): ?\DateTimeInterface
    {
        return $this->startAt;
    }

    public function setStartAt(\DateTimeInterface $startAt): self
    {
        $this->startAt = $startAt;

        return $this;
    }

    public function getFinishAt(): ?\DateTimeInterface
    {
        return $this->finishAt;
    }

    public function setFinishAt(\DateTimeInterface $finishAt): self
    {
        $this->finishAt = $finishAt;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

}
