<?php

namespace App\Entity;

use App\Repository\LicencieRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;

#[ORM\Entity(repositoryClass: LicencieRepository::class)]
class Licencie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $numero_licence = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\ManyToOne(inversedBy: 'licencies')]
    #[JoinColumn(name: 'id_categorie', referencedColumnName: 'id')]
    private ?Categorie $categorie = null;

    #[ORM\ManyToOne(inversedBy: 'licencies')]
    #[JoinColumn(name: 'id_contact', referencedColumnName: 'id')]
    private ?Contact $contact = null;

    public function getNumereLicence(): ?int
    {
        return $this->numero_licence;
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;
        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): static
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getContact(): ?Contact
    {
        return $this->contact;
    }

    public function setContact(?Contact $contact): static
    {
        $this->contact = $contact;

        return $this;
    }
}
