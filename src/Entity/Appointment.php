<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AppointmentRepository")
 */
class Appointment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Patient", mappedBy="appointment", cascade={"persist", "remove"})
     */
    private $patient;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Facility", inversedBy="appointments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $facility;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getPatient(): ?Patient
    {
        return $this->patient;
    }

    public function setPatient(?Patient $patient): self
    {
        $this->patient = $patient;

        // set (or unset) the owning side of the relation if necessary
        $newAppointment = null === $patient ? null : $this;
        if ($patient->getAppointment() !== $newAppointment) {
            $patient->setAppointment($newAppointment);
        }

        return $this;
    }

    public function getFacility(): ?Facility
    {
        return $this->facility;
    }

    public function setFacility(?Facility $facility): self
    {
        $this->facility = $facility;

        return $this;
    }
}
