<?php

namespace App\Entity;

use App\Repository\EditorialRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Integer;

/**
 * @ORM\Entity(repositoryClass=EditorialRepository::class)
 */
class Editorial
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity=Llibre::class, mappedBy="editorial_id")
     */
    private $llibres;

    public function __construct()
    {
        $this->llibres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setid(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection|Llibre[]
     */
    public function getLlibres(): Collection
    {
        return $this->llibres;
    }

    public function addLlibre(Llibre $llibre): self
    {
        if (!$this->llibres->contains($llibre)) {
            $this->llibres[] = $llibre;
            $llibre->setEditorialId($this);
        }

        return $this;
    }

    public function removeLlibre(Llibre $llibre): self
    {
        if ($this->llibres->removeElement($llibre)) {
            // set the owning side to null (unless already changed)
            if ($llibre->getEditorialId() === $this) {
                $llibre->setEditorialId(null);
            }
        }

        return $this;
    }

    public function __toString(){
        //per tornar el nom de l'editorial com un string
        return $this->nom;}
}
