<?php

namespace App\Entity\Reservations;


use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Entity\Patients\PatientsEnregistrer;
use App\Entity\Traits\BaseTimeTrait;
use App\Entity\Utilisateurs;
use App\Repository\Reservations\ReservationsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Uid\Uuid;

/**
 * @ApiResource(
 *      normalizationContext={"groups"={"read:reservation"},},
 *      denormalizationContext={"groups"={"write:reservation"}},
 *      collectionOperations={"get"},
itemOperations={"get"}
)
 * @ApiFilter(SearchFilter::class, properties={"designation": "exact"})
 * @ORM\Entity(repositoryClass=ReservationsRepository::class)
 */
class Reservations
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class=UuidGenerator::class)
     * @Groups({"read:reservation"})
     */
    private Uuid $id;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"read:reservation"})
     */
    private ?int $statut;

    /**
     * @ORM\Column(type="array")
     * @Groups({"read:reservation"})
     */
    private ?array $prestations = [];

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"read:reservation"})
     */
    private ?string $localisation;

    /**
     * @ORM\ManyToOne(targetEntity=PatientsEnregistrer::class, inversedBy="actesReservations")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?PatientsEnregistrer $patientsEnregistrer;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateurs::class, inversedBy="reservations")
     */
    private ?Utilisateurs $gestionnaire;

    /**
     * @ORM\OneToMany(targetEntity=ReservationsHoraires::class, mappedBy="reservation")
     * @Groups({"read:reservation"})
     */
    private Collection $reservationsHoraires;

    use BaseTimeTrait;

    public function __construct()
    {
        $this->reservationsHoraires = new ArrayCollection();
    }

    public function getId(): uuid
    {
        return $this->id;
    }

    public function getStatut(): ?int
    {
        return $this->statut;
    }

    public function setStatut(int $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function getLocalisation(): ?string
    {
        return $this->localisation;
    }

    public function setLocalisation(?string $localisation): self
    {
        $this->localisation = $localisation;

        return $this;
    }

    public function getPatientsEnregistrer(): ?PatientsEnregistrer
    {
        return $this->patientsEnregistrer;
    }

    public function setPatientsEnregistrer(?PatientsEnregistrer $patientsEnregistrer): self
    {
        $this->patientsEnregistrer = $patientsEnregistrer;

        return $this;
    }

    public function getGestionnaire(): ?Utilisateurs
    {
        return $this->gestionnaire;
    }

    public function setGestionnaire(?Utilisateurs $gestionnaire): self
    {
        $this->gestionnaire = $gestionnaire;

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
            $reservationsHoraire->setReservation($this);
        }

        return $this;
    }

    public function removeReservationsHoraire(ReservationsHoraires $reservationsHoraire): self
    {
        if ($this->reservationsHoraires->removeElement($reservationsHoraire)) {
            // set the owning side to null (unless already changed)
            if ($reservationsHoraire->getReservation() === $this) {
                $reservationsHoraire->setReservation(null);
            }
        }

        return $this;
    }

    /**
     * @return array|null
     */
    public function getPrestations(): ?array
    {
        return $this->prestations;
    }

    /**
     * @param array|null $prestations
     * @return Reservations
     */
    public function setPrestations(?array $prestations): self
    {
        $this->prestations = $prestations;
        return $this;
    }


}
