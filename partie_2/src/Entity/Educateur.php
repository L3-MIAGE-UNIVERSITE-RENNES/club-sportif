<?php

namespace App\Entity;

use App\Repository\EducateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: EducateurRepository::class)]
class Educateur implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private bool $est_administrateur;

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $mot_de_passe = null;

    #[ORM\OneToMany(mappedBy: 'expediteur', targetEntity: MailEducateur::class)]
    private Collection $mailEnvoyes;

    #[ORM\OneToMany(mappedBy: 'expediteur', targetEntity: MailContact::class)]
    private Collection $mailContactEnvoyes;

    #[ORM\ManyToMany(targetEntity: MailEducateur::class, mappedBy: 'destinataires', fetch: 'EAGER')]
    private Collection $mailRecus;

    public function __construct()
    {
        $this->mailEnvoyes = new ArrayCollection();
        $this->mailContactEnvoyes = new ArrayCollection();
        $this->mailRecus = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id ): ?int
    {
        $this->id = $id;
        return $this->id;
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $admin = $this->est_administrateur;

        if($admin == 1){
            $roles[] = 'ROLE_ADMIN';
        }

        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        in_array('ROLE_ADMIN', $roles) ? $this->est_administrateur = 0 : $this->est_administrateur = 1 ;
        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->mot_de_passe;
    }

    public function setPassword(string $mot_de_passe): static
    {
        $this->mot_de_passe = $mot_de_passe;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection<int, MailEducateur>
     */
    public function getMailEnvoyes(): Collection
    {
        return $this->mailEnvoyes;
    }

    public function addMailEducateur(MailEducateur $mailEducateur): static
    {
        if (!$this->mailEnvoyes->contains($mailEducateur)) {
            $this->mailEnvoyes->add($mailEducateur);
            $mailEducateur->setExpediteur($this);
        }

        return $this;
    }

    public function removeMailEducateur(MailEducateur $mailEducateur): static
    {
        if ($this->mailEnvoyes->removeElement($mailEducateur)) {
            // set the owning side to null (unless already changed)
            if ($mailEducateur->getExpediteur() === $this) {
                $mailEducateur->setExpediteur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, MailEducateur>
     */
    public function getMailRecus(): Collection
    {
        return $this->mailRecus;
    }

    public function addMailRecu(MailEducateur $mailRecu): static
    {
        if (!$this->mailRecus->contains($mailRecu)) {
            $this->mailRecus->add($mailRecu);
            $mailRecu->addDestinataire($this);
        }

        return $this;
    }

    public function removeMailRecu(MailEducateur $mailRecu): static
    {
        if ($this->mailRecus->removeElement($mailRecu)) {
            $mailRecu->removeDestinataire($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, MailContact>
     */
    public function getMailContactEnvoyes(): Collection
    {
        return $this->mailContactEnvoyes;
    }

    public function addMailContact(MailContact $mailContact): static
    {
        if (!$this->mailContactEnvoyes->contains($mailContact)) {
            $this->mailContactEnvoyes->add($mailContact);
            $mailContact->setExpediteur($this);
        }

        return $this;
    }

    public function removeMailContact(MailContact $mailContact): static
    {
        if ($this->mailContactEnvoyes->removeElement($mailContact)) {
            // set the owning side to null (unless already changed)
            if ($mailContact->getExpediteur() === $this) {
                $mailContact->setExpediteur(null);
            }
        }

        return $this;
    }
}
