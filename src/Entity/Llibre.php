<?php

namespace App\Entity;

use App\Repository\LlibreRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Annotation;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=LlibreRepository::class)
 */
class Llibre
{
 
    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=20)
     * @Assert\NotBlank()
     */
    private $isbn;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $titol;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank()
     */
    private $autor;

    /**
     * @ORM\Column(type="integer")
     *  @Assert\Range(
     *      min = 100,
     *      max = 10000,
     *      notInRangeMessage = "La   quantitat   depàgines ha de ser major que 100",
     * )
     */
    private $pagines;

    /**
     * @ORM\ManyToOne(targetEntity=Editorial::class, inversedBy="llibres")
     */
    private $editorial_id;

     /**
     * 
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
