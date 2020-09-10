<?php

namespace App\Entity;

use App\Repository\PersonneRepository;
use Doctrine\ORM\Mapping as ORM;



 /**
 * @ORM\Entity(repositoryClass=PersonneRepository::class)
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"personne" = "Personne", "morale" = "PersonneMorale","physique" = "PersonnePhysique"})
 */

class Personne 
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
    protected $adresse;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $aggree;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getAggree(): ?bool
    {
        return $this->aggree;
    }

    public function setAggree(bool $aggree): self
    {
        $this->aggree = $aggree;

        return $this;
    }
}
