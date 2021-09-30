<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReservationRepository::class)
 */
class Reservation
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
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="reservations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $User;

    /**
     * @ORM\ManyToMany(targetEntity=Massage::class)
     */
    private $ReservationMassage;

    /**
     * @ORM\Column(type="datetime")
     */
    private $ReservationAt;

    public function __construct()
    {
        $this->ReservationMassage = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): self
    {
        $this->User = $User;

        return $this;
    }

    /**
     * @return Collection|Massage[]
     */
    public function getReservationMassage(): Collection
    {
        return $this->ReservationMassage;
    }

    public function addReservationMassage(Massage $reservationMassage): self
    {
        if (!$this->ReservationMassage->contains($reservationMassage)) {
            $this->ReservationMassage[] = $reservationMassage;
        }

        return $this;
    }

    public function removeReservationMassage(Massage $reservationMassage): self
    {
        $this->ReservationMassage->removeElement($reservationMassage);

        return $this;
    }

    public function getReservationAt(): ?\DateTimeInterface
    {
        return $this->ReservationAt;
    }

    public function setReservationAt(\DateTimeInterface $ReservationAt): self
    {
        $this->ReservationAt = $ReservationAt;

        return $this;
    }
}
