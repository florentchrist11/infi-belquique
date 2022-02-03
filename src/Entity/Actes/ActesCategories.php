<?php

namespace App\Entity\Actes;


use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Helpers\Systems\SlugHelpers;
use App\Repository\Actes\ActesCategoriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *      normalizationContext={"groups"={"read:actes_categories"},},
 *      denormalizationContext={"groups"={"write:actes_categories"}},
 *      collectionOperations={"get"},
itemOperations={"get"}
)
 * @ApiFilter(SearchFilter::class, properties={"designation": "exact"})
 * @ORM\Entity(repositoryClass=ActesCategoriesRepository::class)
 */
class ActesCategories
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"read:actes_categories"})
     */
    private ?int $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read:actes_categories"})
     */
    private ?string $designation;

    /**
     * @Groups({"read:actes_categories"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $images;

    /**
     * @Groups({"read:actes_categories"})
     */
    private string $slug;

    /**
     * @Groups({"read:actes_categories"})
     * @ORM\OneToMany(targetEntity=ActesPrestations::class, mappedBy="categorie")
     */
    private Collection $actesPrestations;

    public function __construct()
    {
        $this->actesPrestations = new ArrayCollection();
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

    public function getSlug(): string
    {
        $slugHelper = new SlugHelpers();
        return $this->slug = $slugHelper->slugify($this->getDesignation());
    }


    /**
     * @return Collection|ActesPrestations[]
     */
    public function getActesPrestations(): Collection
    {
        return $this->actesPrestations;
    }

    public function addActesPrestation(ActesPrestations $actesPrestation): self
    {
        if (!$this->actesPrestations->contains($actesPrestation)) {
            $this->actesPrestations[] = $actesPrestation;
            $actesPrestation->setCategorie($this);
        }

        return $this;
    }

    public function removeActesPrestation(ActesPrestations $actesPrestation): self
    {
        if ($this->actesPrestations->removeElement($actesPrestation)) {
            // set the owning side to null (unless already changed)
            if ($actesPrestation->getCategorie() === $this) {
                $actesPrestation->setCategorie(null);
            }
        }

        return $this;
    }
}
