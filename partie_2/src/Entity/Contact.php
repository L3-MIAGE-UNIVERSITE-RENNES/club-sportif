<?php

namespace App\Entity;

use App\Repository\ContactRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContactRepository::class)]
class Contact
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column( name: 'numero_tel', length: 255)]
    private ?string $numeroTel = null;

    #[ORM\OneToMany(mappedBy: 'contact', targetEntity: Licencie::class)]
    private Collection $licencies;

    #[ORM\ManyToMany(targetEntity: MailContact::class, mappedBy: 'destinataires', fetch: 'EAGER')]
    private Collection $mailRecus;

    public function __construct()
    {
        $this->licencies = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getNumeroTel(): ?string
    {
        return $this->numeroTel;
    }

    public function setNumeroTel(string $numeroTel): static
    {
        $this->numeroTel = $numeroTel;

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
            $licencie->setContact($this);
        }

        return $this;
    }

    public function removeLicencie(Licencie $licencie): static
    {
        if ($this->licencies->removeElement($licencie)) {
            // set the owning side to null (unless already changed)
            if ($licencie->getContact() === $this) {
                $licencie->setContact(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, MailContact>
     */
    public function getMailRecus(): Collection
    {
        return $this->mailRecus;
    }

    public function addMailRecu(MailContact $mailRecu): static
    {
        if (!$this->mailRecus->contains($mailRecu)) {
            $this->mailRecus->add($mailRecu);
            $mailRecu->addDestinataire($this);
        }

        return $this;
    }

    public function removeMailRecu(MailContact $mailRecu): static
    {
        if ($this->mailRecus->removeElement($mailRecu)) {
            $mailRecu->removeDestinataire($this);
        }

        return $this;
    }
}
