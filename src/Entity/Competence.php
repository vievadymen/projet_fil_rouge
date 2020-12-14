<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CompetenceRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 * normalizationContext={"groups"={"read:competence"}},
 * routePrefix= "/admin",
 * collectionOperations={"get","post"},
 * itemOperations={"get","put"},
 * )
 * @ORM\Entity(repositoryClass=CompetenceRepository::class)
 */
class Competence
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read:competence"})
     */
    private $libelle;

    /**
     * @ORM\OneToMany(targetEntity=Niveau::class, mappedBy="competences")
     */
    private $niveau;

    /**
     * @ORM\ManyToMany(targetEntity=GroupeDeCompetences::class, mappedBy="competences")
     */
    private $groupeDeCompetences;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Descriptif;

    /**
     * @ORM\Column(type="boolean")
     */
    private $achivage;

    public function __construct()
    {
        $this->niveau = new ArrayCollection();
        $this->groupeDeCompetences = new ArrayCollection();
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

    /**
     * @return Collection|Niveau[]
     */
    public function getNiveau(): Collection
    {
        return $this->niveau;
    }

    public function addNiveau(Niveau $niveau): self
    {
        if (!$this->niveau->contains($niveau)) {
            $this->niveau[] = $niveau;
            $niveau->setCompetences($this);
        }

        return $this;
    }

    public function removeNiveau(Niveau $niveau): self
    {
        if ($this->niveau->removeElement($niveau)) {
            // set the owning side to null (unless already changed)
            if ($niveau->getCompetences() === $this) {
                $niveau->setCompetences(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|GroupeDeCompetences[]
     */
    public function getGroupeDeCompetences(): Collection
    {
        return $this->groupeDeCompetences;
    }

    public function addGroupeDeCompetence(GroupeDeCompetences $groupeDeCompetence): self
    {
        if (!$this->groupeDeCompetences->contains($groupeDeCompetence)) {
            $this->groupeDeCompetences[] = $groupeDeCompetence;
            $groupeDeCompetence->addCompetence($this);
        }

        return $this;
    }

    public function removeGroupeDeCompetence(GroupeDeCompetences $groupeDeCompetence): self
    {
        if ($this->groupeDeCompetences->removeElement($groupeDeCompetence)) {
            $groupeDeCompetence->removeCompetence($this);
        }

        return $this;
    }

    public function getDescriptif(): ?string
    {
        return $this->Descriptif;
    }

    public function setDescriptif(string $Descriptif): self
    {
        $this->Descriptif = $Descriptif;

        return $this;
    }

    public function getAchivage(): ?bool
    {
        return $this->achivage;
    }

    public function setAchivage(bool $achivage): self
    {
        $this->achivage = $achivage;

        return $this;
    }
}
