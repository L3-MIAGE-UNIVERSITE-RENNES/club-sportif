<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $code_raccourci = null;

    #[ORM\OneToMany(mappedBy: 'categorie', targetEntity: Licencie::class)]
    private Collection $licencies;

    public function __construct()
    {
        $this->licencies = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getCodeRaccourci(): ?string
    {
        return $this->code_raccourci;
    }

    public function setCodeRaccourci(string $code_raccourci): static
    {
        $this->code_raccourci = $code_raccourci;

        return $this;
    }

    /**
     * @return Collection<int, Licencie>
     */
    public function getLicencies(): Collection
    {
        return $this->licencies;
    }

    public function addLicencie(Licencie $licencie): static
    {
        if (!$this->licencies->contains($licencie)) {
            $this->licencies->add($licencie);
            $licencie->setCategorie($this);
        }

        return $this;
    }

    public function removeLicencie(Licencie $licencie): static
    {
        if ($this->licencies->removeElement($licencie)) {
            // set the owning side to null (unless already changed)
            if ($licencie->getCategorie() === $this) {
                $licencie->setCategorie(null);
            }
        }

        return $this;
    }
}
