<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FacilityRepository")
 */
class Facility
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $freeSpace;

    /**
     * @ORM\Column(type="integer")
     */
    private $occupiedSpace;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Address", inversedBy="facility", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $address;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Appointment", mappedBy="facility")
     */
    private $appointments;

    public function __construct()
    {
        $this->appointments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getFreeSpace(): ?int
    {
        return $this->freeSpace;
    }

    public function setFreeSpace(int $freeSpace): self
    {
        $this->freeSpace = $freeSpace;

        return $this;
    }

    public function getOccupiedSpace(): ?int
    {
        return $this->occupiedSpace;
    }

    public function setOccupiedSpace(int $occupiedSpace): self
    {
        $this->occupiedSpace = $occupiedSpace;

        return $this;
    }

    public function getAddress(): ?Address
    {
        return $this->address;
    }

    public function setAddress(Address $address): self
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return Collection|Appointment[]
     */
    public function getAppointments(): Collection
    {
        return $this->appointments;
    }

    public function addAppointment(Appointment $appointment): self
    {
        if (!$this->appointments->contains($appointment)) {
            $this->appointments[] = $appointment;
            $appointment->setFacility($this);
        }

        return $this;
    }

    public function removeAppointment(Appointment $appointment): self
    {
        if ($this->appointments->contains($appointment)) {
            $this->appointments->removeElement($appointment);
            // set the owning side to null (unless already changed)
            if ($appointment->getFacility() === $this) {
                $appointment->setFacility(null);
            }
        }

        return $this;
    }
}
