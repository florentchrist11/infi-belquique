<?php

namespace App\Entity\Actes;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Repository\Actes\ActesPrestationsRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ApiResource(
 *      normalizationContext={"groups"={"read:actes_prestations"}},
 *      denormalizationContext={"groups"={"write:actes_prestations"}},
 *      collectionOperations={"get"},
itemOperations={"get"}
)
 * @ApiFilter(SearchFilter::class, properties={"designation": "exact"})
 * @ORM\Entity(repositoryClass=ActesPrestationsRepository::class)
 */
class ActesPrestations
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"read:actes_prestations", "read:actes_categories"})
     */
    private ?int $id;

    /**
     * @ORM\ManyToOne(targetEntity=ActesCategories::class, inversedBy="actesPrestations")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?ActesCategories $categorie;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"read:actes_prestations", "read:actes_categories"})
     */
    private ?string $designation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategorie(): ?ActesCategories
    {
        return $this->categorie;
    }

    public function setCategorie(?ActesCategories $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(?string $designation): self
    {
        $this->designation = $designation;

        return $this;
    }

}
