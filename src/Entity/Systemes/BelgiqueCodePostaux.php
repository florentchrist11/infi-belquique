<?php

namespace App\Entity\Systemes;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Entity\Patients\PatientsEnregistrer;
use App\Repository\Systemes\BelgiqueCodePostauxRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *      normalizationContext={"groups"={"read:code"},},
 *      denormalizationContext={"groups"={"write:code"}},
 *      collectionOperations={"get"},
itemOperations={"get"}
)
 * @ApiFilter(SearchFilter::class, properties={"code": "partial"})
 * @ORM\Entity(repositoryClass=BelgiqueCodePostauxRepository::class)
 */
class BelgiqueCodePostaux
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"read:code"})
     */
    private ?int $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read:code"})
     */
    private string $code;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read:code"})
     */
    private string $localite;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=3)
     * @Groups({"read:code"})
     */
    private string $latitude;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=3)
     * @Groups({"read:code"})
     */
    private string $longitude;

    /**
     * @ORM\OneToMany(targetEntity=PatientsEnregistrer::class, mappedBy="codePostal")
     */
    private Collection $patientsEnregistrers;

    public function __construct()
    {
        $this->patientsEnregistrers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getLocalite(): ?string
    {
        return $this->localite;
    }

    public function setLocalite(string $localite): self
    {
        $this->localite = $localite;

        return $this;
    }

    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    public function setLatitude(string $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    public function setLongitude(string $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * @return Collection|PatientsEnregistrer[]
     */
    public function getPatientsEnregistrers(): Collection
    {
        return $this->patientsEnregistrers;
    }

    public function addPatientsEnregistrer(PatientsEnregistrer $patientsEnregistrer): self
    {
        if (!$this->patientsEnregistrers->contains($patientsEnregistrer)) {
            $this->patientsEnregistrers[] = $patientsEnregistrer;
            $patientsEnregistrer->setCodePostal($this);
        }

        return $this;
    }

    public function removePatientsEnregistrer(PatientsEnregistrer $patientsEnregistrer): self
    {
        if ($this->patientsEnregistrers->removeElement($patientsEnregistrer)) {
            // set the owning side to null (unless already changed)
            if ($patientsEnregistrer->getCodePostal() === $this) {
                $patientsEnregistrer->setCodePostal(null);
            }
        }

        return $this;
    }
}
