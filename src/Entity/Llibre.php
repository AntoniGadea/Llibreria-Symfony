<?php

namespace App\Entity;

use App\Repository\LlibreRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Annotation;

/**
 * @ORM\Entity(repositoryClass=LlibreRepository::class)
 */
class Llibre
{
 
    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=20)
     */
    private $isbn;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titol;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $autor;

    /**
     * @ORM\Column(type="integer")
     */
    private $pagines;

    /**
     * @ORM\ManyToOne(targetEntity=Editorial::class, inversedBy="llibres")
     */
    private $editorial;

     /**
     * @ORM\Column(type="string")
     */


    public function getIsbn(): ?string
    {
        return $this->isbn;
    }

    public function setIsbn(string $isbn): self
    {
        $this->isbn = $isbn;

        return $this;
    }

    public function getTitol(): ?string
    {
        return $this->titol;
    }

    public function setTitol(string $titol): self
    {
        $this->titol = $titol;

        return $this;
    }

    public function getAutor(): ?string
    {
        return $this->autor;
    }

    public function setAutor(string $autor): self
    {
        $this->autor = $autor;

        return $this;
    }

    public function getPagines(): ?int
    {
        return $this->pagines;
    }

    public function setPagines(int $pagines): self
    {
        $this->pagines = $pagines;

        return $this;
    }

    public function getEditorialId(): ?Editorial
    {
        return $this->editorial_id;
    }

    public function setEditorialId(?Editorial $editorial_id): self
    {
        $this->editorial_id = $editorial_id;

        return $this;
    }
}
