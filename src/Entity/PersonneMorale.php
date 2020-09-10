<?php

namespace App\Entity;

use App\Repository\PersonneMoraleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PersonneMoraleRepository::class)
 */
class PersonneMorale extends Personne
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
    private $denomination;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $rccm;

    /**
     * @ORM\OneToMany(targetEntity=PersonnePhysique::class, mappedBy="personneMorale")
     */
    private $personnePhysiques;

    public function __construct()
    {
        $this->personnePhysiques = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDenomination(): ?string
    {
        return $this->denomination;
    }

    public function setDenomination(string $denomination): self
    {
        $this->denomination = $denomination;

        return $this;
    }

    public function getRccm(): ?string
    {
        return $this->rccm;
    }

    public function setRccm(string $rccm): self
    {
        $this->rccm = $rccm;

        return $this;
    }

    /**
     * @return Collection|PersonnePhysique[]
     */
    public function getPersonnePhysiques(): Collection
    {
        return $this->personnePhysiques;
    }

    public function addPersonnePhysique(PersonnePhysique $personnePhysique): self
    {
        if (!$this->personnePhysiques->contains($personnePhysique)) {
            $this->personnePhysiques[] = $personnePhysique;
            $personnePhysique->setPersonneMorale($this);
        }

        return $this;
    }

    public function removePersonnePhysique(PersonnePhysique $personnePhysique): self
    {
        if ($this->personnePhysiques->contains($personnePhysique)) {
            $this->personnePhysiques->removeElement($personnePhysique);
            // set the owning side to null (unless already changed)
            if ($personnePhysique->getPersonneMorale() === $this) {
                $personnePhysique->setPersonneMorale(null);
            }
        }

        return $this;
    }
}
