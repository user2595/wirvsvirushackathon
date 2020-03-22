<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PatientSymptomRepository")
 */
class PatientSymptom
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Patient", inversedBy="patientSymptoms")
     * @ORM\JoinColumn(nullable=false)
     */
    private $patient;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Symptom", inversedBy="patientSymptoms")
     * @ORM\JoinColumn(nullable=false)
     */
    private $symptom;

    /**
     * @ORM\Column(type="date")
     */
    private $startingDate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPatient(): ?Patient
    {
        return $this->patient;
    }

    public function setPatient(?Patient $patient): self
    {
        $this->patient = $patient;

        return $this;
    }

    public function getSymptom(): ?Symptom
    {
        return $this->symptom;
    }

    public function setSymptom(?Symptom $symptom): self
    {
        $this->symptom = $symptom;

        return $this;
    }

    public function getStartingDate(): ?\DateTimeInterface
    {
        return $this->startingDate;
    }

    public function setStartingDate(\DateTimeInterface $startingDate): self
    {
        $this->startingDate = $startingDate;

        return $this;
    }
}
