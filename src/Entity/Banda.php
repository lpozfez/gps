<?php

namespace App\Entity;

use App\Repository\BandaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BandaRepository::class)]
class Banda
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $min = null;

    #[ORM\Column]
    private ?int $max = null;

    #[ORM\ManyToOne(inversedBy: 'banda')]
    private ?Mensaje $mensaje = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMin(): ?int
    {
        return $this->min;
    }

    public function setMin(int $min): self
    {
        $this->min = $min;

        return $this;
    }

    public function getMax(): ?int
    {
        return $this->max;
    }

    public function setMax(int $max): self
    {
        $this->max = $max;

        return $this;
    }

    public function getMensaje(): ?Mensaje
    {
        return $this->mensaje;
    }

    public function setMensaje(?Mensaje $mensaje): self
    {
        $this->mensaje = $mensaje;

        return $this;
    }
}
