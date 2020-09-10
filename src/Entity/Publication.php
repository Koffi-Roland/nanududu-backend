<?php

namespace App\Entity;

use App\Repository\PublicationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PublicationRepository::class)
 */
class Publication
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="datetime")
     */
    private $expiration;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $libelle;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=PersonnePhysique::class, inversedBy="publications")
     * @ORM\JoinColumn(nullable=false)
     */
    private $personnePhysique;

    /**
     * @ORM\OneToMany(targetEntity=Souscription::class, mappedBy="publication", orphanRemoval=true)
     */
    private $souscriptions;

    /**
     * @ORM\ManyToMany(targetEntity=Tag::class, inversedBy="publications")
     */
    private $tags;

    public function __construct()
    {
        $this->souscriptions = new ArrayCollection();
        $this->tags = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getExpiration(): ?\DateTimeInterface
    {
        return $this->expiration;
    }

    public function setExpiration(\DateTimeInterface $expiration): self
    {
        $this->expiration = $expiration;

        return $this;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPersonnePhysique(): ?PersonnePhysique
    {
        return $this->personnePhysique;
    }

    public function setPersonnePhysique(?PersonnePhysique $personnePhysique): self
    {
        $this->personnePhysique = $personnePhysique;

        return $this;
    }

    /**
     * @return Collection|Souscription[]
     */
    public function getSouscriptions(): Collection
    {
        return $this->souscriptions;
    }

    public function addSouscription(Souscription $souscription): self
    {
        if (!$this->souscriptions->contains($souscription)) {
            $this->souscriptions[] = $souscription;
            $souscription->setPublication($this);
        }

        return $this;
    }

    public function removeSouscription(Souscription $souscription): self
    {
        if ($this->souscriptions->contains($souscription)) {
            $this->souscriptions->removeElement($souscription);
            // set the owning side to null (unless already changed)
            if ($souscription->getPublication() === $this) {
                $souscription->setPublication(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Tag[]
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags[] = $tag;
        }

        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        if ($this->tags->contains($tag)) {
            $this->tags->removeElement($tag);
        }

        return $this;
    }
}
