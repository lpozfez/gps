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

    #[ORM\Column]
    private ?bool $validado = null;

    #[ORM\OneToMany(mappedBy: 'mensaje', targetEntity: Modo::class)]
    private Collection $modo;

    #[ORM\OneToMany(mappedBy: 'mensaje', targetEntity: Banda::class)]
    private Collection $banda;

    #[ORM\OneToMany(mappedBy: 'mensaje', targetEntity: User::class)]
    private Collection $user;

    #[ORM\Column]
    private ?int $juez = null;

    public function __construct()
    {
        $this->modo = new ArrayCollection();
        $this->banda = new ArrayCollection();
        $this->user = new ArrayCollection();
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

    public function setValidado(bool $validado): self
    {
        $this->validado = $validado;

        return $this;
    }

    /**
     * @return Collection<int, Modo>
     */
    public function getModo(): Collection
    {
        return $this->modo;
    }

    public function addModo(Modo $modo): self
    {
        if (!$this->modo->contains($modo)) {
            $this->modo->add($modo);
            $modo->setMensaje($this);
        }

        return $this;
    }

    public function removeModo(Modo $modo): self
    {
        if ($this->modo->removeElement($modo)) {
            // set the owning side to null (unless already changed)
            if ($modo->getMensaje() === $this) {
                $modo->setMensaje(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Banda>
     */
    public function getBanda(): Collection
    {
        return $this->banda;
    }

    public function addBanda(Banda $banda): self
    {
        if (!$this->banda->contains($banda)) {
            $this->banda->add($banda);
            $banda->setMensaje($this);
        }

        return $this;
    }

    public function removeBanda(Banda $banda): self
    {
        if ($this->banda->removeElement($banda)) {
            // set the owning side to null (unless already changed)
            if ($banda->getMensaje() === $this) {
                $banda->setMensaje(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(User $user): self
    {
        if (!$this->user->contains($user)) {
            $this->user->add($user);
            $user->setMensaje($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->user->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getMensaje() === $this) {
                $user->setMensaje(null);
            }
        }

        return $this;
    }

    public function getJuez(): ?int
    {
        return $this->juez;
    }

    public function setJuez(int $juez): self
    {
        $this->juez = $juez;

        return $this;
    }
}
