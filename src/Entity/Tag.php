<?php

namespace App\Entity;

use App\Repository\TagRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TagRepository::class)
 */
class Tag
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $libelle;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity=Publication::class, mappedBy="tags")
     */
    private $publications;

    /**
     * @ORM\ManyToMany(targetEntity=Sos::class, mappedBy="tags")
     */
    private $sos;

    public function __construct()
    {
        $this->publications = new ArrayCollection();
        $this->sos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection|Publication[]
     */
    public function getPublications(): Collection
    {
        return $this->publications;
    }

    public function addPublication(Publication $publication): self
    {
        if (!$this->publications->contains($publication)) {
            $this->publications[] = $publication;
            $publication->addTag($this);
        }

        return $this;
    }

    public function removePublication(Publication $publication): self
    {
        if ($this->publications->contains($publication)) {
            $this->publications->removeElement($publication);
            $publication->removeTag($this);
        }

        return $this;
    }

    /**
     * @return Collection|Sos[]
     */
    public function getSos(): Collection
    {
        return $this->sos;
    }

    public function addSo(Sos $so): self
    {
        if (!$this->sos->contains($so)) {
            $this->sos[] = $so;
            $so->addTag($this);
        }

        return $this;
    }

    public function removeSo(Sos $so): self
    {
        if ($this->sos->contains($so)) {
            $this->sos->removeElement($so);
            $so->removeTag($this);
        }

        return $this;
    }
}
