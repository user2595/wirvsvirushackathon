<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SymptomRepository")
 */
class Symptom
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
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $degree;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PatientSymptom", mappedBy="symptom", orphanRemoval=true)
     */
    private $patientSymptoms;

    public function __construct()
    {
        $this->patientSymptoms = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDegree(): ?int
    {
        return $this->degree;
    }

    public function setDegree(int $degree): self
    {
        $this->degree = $degree;

        return $this;
    }

    /**
     * @return Collection|PatientSymptom[]
     */
    public function getPatientSymptoms(): Collection
    {
        return $this->patientSymptoms;
    }

    public function addPatientSymptom(PatientSymptom $patientSymptom): self
    {
        if (!$this->patientSymptoms->contains($patientSymptom)) {
            $this->patientSymptoms[] = $patientSymptom;
            $patientSymptom->setSymptom($this);
        }

        return $this;
    }

    public function removePatientSymptom(PatientSymptom $patientSymptom): self
    {
        if ($this->patientSymptoms->contains($patientSymptom)) {
            $this->patientSymptoms->removeElement($patientSymptom);
            // set the owning side to null (unless already changed)
            if ($patientSymptom->getSymptom() === $this) {
                $patientSymptom->setSymptom(null);
            }
        }

        return $this;
    }
}
