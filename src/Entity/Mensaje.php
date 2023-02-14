<?php

namespace App\Entity;

use App\Repository\MensajeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MensajeRepository::class)]
class Mensaje
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $fecha = null;

    #[ORM\Column(nullable: true)]
    private ?bool $validado = null;

    #[ORM\ManyToOne(inversedBy: 'user')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'banda')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Banda $banda = null;

    #[ORM\ManyToOne(inversedBy: 'modo')]
    private ?Modo $modo = null;

    #[ORM\Column(nullable: true)]
    private ?int $juez = null;


    public function __construct()
    {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function isValidado(): ?bool
    {
        return $this->validado;
    }

    public function setValidado(?bool $validado): self
    {
        $this->validado = $validado;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getBanda(): ?Banda
    {
        return $this->banda;
    }

    public function setBanda(?Banda $banda): self
    {
        $this->banda = $banda;

        return $this;
    }

    public function getModo(): ?Modo
    {
        return $this->modo;
    }

    public function setModo(?Modo $modo): self
    {
        $this->modo = $modo;

        return $this;
    }

    public function toArray() 
    { 
        return [ 
            'id' => $this->getId(), 
            'fecha' => $this->getFecha(), 
            'validado' => $this->isValidado(),
            'modo' => $this->getModo(),
            'banda' => $this->getBanda(),
            'user' => $this->getUser(), 
            'juez' => $this->getJuez(),
        ]; 
    }

    public function getJuez(): ?int
    {
        return $this->juez;
    }

    public function setJuez(?int $juez): self
    {
        $this->juez = $juez;

        return $this;
    }
}
