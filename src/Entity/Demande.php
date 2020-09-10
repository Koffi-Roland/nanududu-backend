<?php

namespace App\Entity;

use App\Repository\DemandeRepository;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass=DemandeRepository::class)
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"demande" = "Demande", "sos" = "Sos","souscription" = "Souscription"})
 */


class Demande
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
    protected $date;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $etat;

    /**
     * @ORM\ManyToOne(targetEntity=PersonnePhysique::class, inversedBy="demandes")
     * @ORM\JoinColumn(nullable=true)
     */
    private $personnePhysique;

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

    public function getEtat(): ?bool
    {
        return $this->etat;
    }

    public function setEtat(bool $etat): self
    {
        $this->etat = $etat;

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
}
