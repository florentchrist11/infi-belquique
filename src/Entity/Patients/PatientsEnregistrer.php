<?php

namespace App\Entity\Patients;

use App\Entity\Reservations\Reservations;
use App\Entity\Systemes\BelgiqueCodePostaux;
use App\Repository\Patients\PatientsEnregistrerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PatientsEnregistrerRepository::class)
 */
class PatientsEnregistrer
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
    private ?string $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $prenom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $contact;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $rue;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $numeroPorte;

    /**
     * @ORM\OneToMany(targetEntity=Reservations::class, mappedBy="patientsEnregistrer")
     */
    private Collection $actesReservations;

    /**
     * @ORM\ManyToOne(targetEntity=BelgiqueCodePostaux::class, inversedBy="patientsEnregistrers")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?BelgiqueCodePostaux $codePostal;

    public function __construct()
    {
        $this->actesReservations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getContact(): ?string
    {
        return $this->contact;
    }

    public function setContact(?string $contact): self
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getNumeroPorte(): ?string
    {
        return $this->numeroPorte;
    }

    /**
     * @param string|null $numeroPorte
     * @return PatientsEnregistrer
     */
    public function setNumeroPorte(?string $numeroPorte): self
    {
        $this->numeroPorte = $numeroPorte;
        return $this;
    }


    /**
     * @return Collection|Reservations[]
     */
    public function getActesReservations(): Collection
    {
        return $this->actesReservations;
    }

    public function addActesReservation(Reservations $actesReservation): self
    {
        if (!$this->actesReservations->contains($actesReservation)) {
            $this->actesReservations[] = $actesReservation;
            $actesReservation->setPatientsEnregistrer($this);
        }

        return $this;
    }

    public function removeActesReservation(Reservations $actesReservation): self
    {
        if ($this->actesReservations->removeElement($actesReservation)) {
            // set the owning side to null (unless already changed)
            if ($actesReservation->getPatientsEnregistrer() === $this) {
                $actesReservation->setPatientsEnregistrer(null);
            }
        }

        return $this;
    }

    public function getCodePostal(): ?BelgiqueCodePostaux
    {
        return $this->codePostal;
    }

    public function setCodePostal(?BelgiqueCodePostaux $codePostal): self
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getRue(): ?string
    {
        return $this->rue;
    }

    /**
     * @param string|null $rue
     * @return PatientsEnregistrer
     */
    public function setRue(?string $rue): PatientsEnregistrer
    {
        $this->rue = $rue;
        return $this;
    }


}
