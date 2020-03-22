<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use App\Entity\Symptom;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PatientRepository")
 */
class Patient
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $surname;

    /**
     * @ORM\Column(type="date")
     */
    private $birthdate;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private $phoneNr;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Address", inversedBy="patients", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $address;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $note;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\PreExistingCondition", inversedBy="patients")
     */
    private $preExistingConditions;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\RiskFactor", inversedBy="patients")
     */
    private $riskFactors;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Appointment", inversedBy="patient", cascade={"persist", "remove"})
     */
    private $appointment;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Test", mappedBy="tests", cascade={"persist", "remove"})
     */
    private $test;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PatientSymptom", mappedBy="patient", orphanRemoval=true)
     */
    private $patientSymptoms;

    public function __construct()
    {
        $this->preExistingConditions = new ArrayCollection();
        $this->riskFactors = new ArrayCollection();
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

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    public function getBirthdate(): ?\DateTimeInterface
    {
        return $this->birthdate;
    }

    public function setBirthdate(\DateTimeInterface $birthdate): self
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    public function getPhoneNr(): ?string
    {
        return $this->phoneNr;
    }

    public function setPhoneNr(?string $phoneNr): self
    {
        $this->phoneNr = $phoneNr;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getAddress(): ?Address
    {
        return $this->address;
    }

    public function setAddress(?Address $address): self
    {
        $this->address = $address;

        return $this;
    }


    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(?string $note): self
    {
        $this->note = $note;

        return $this;
    }

    /**
     * @return Collection|PreExistingCondition[]
     */
    public function getPreExistingConditions(): Collection
    {
        return $this->preExistingConditions;
    }

    public function addPreExistingCondition(PreExistingCondition $preExistingCondition): self
    {
        if (!$this->preExistingConditions->contains($preExistingCondition)) {
            $this->preExistingConditions[] = $preExistingCondition;
        }

        return $this;
    }

    public function removePreExistingCondition(PreExistingCondition $preExistingCondition): self
    {
        if ($this->preExistingConditions->contains($preExistingCondition)) {
            $this->preExistingConditions->removeElement($preExistingCondition);
        }

        return $this;
    }

    /**
     * @return Collection|RiskFactor[]
     */
    public function getRiskFactors(): Collection
    {
        return $this->riskFactors;
    }

    public function addRiskFactor(RiskFactor $riskFactor): self
    {
        if (!$this->riskFactors->contains($riskFactor)) {
            $this->riskFactors[] = $riskFactor;
        }

        return $this;
    }

    public function removeRiskFactor(RiskFactor $riskFactor): self
    {
        if ($this->riskFactors->contains($riskFactor)) {
            $this->riskFactors->removeElement($riskFactor);
        }

        return $this;
    }

    public function getAppointment(): ?Appointment
    {
        return $this->appointment;
    }

    public function setAppointment(?Appointment $appointment): self
    {
        $this->appointment = $appointment;

        return $this;
    }

    public function getTest(): ?Test
    {
        return $this->test;
    }

    public function setTest(Test $test): self
    {
        $this->test = $test;

        // set the owning side of the relation if necessary
        if ($test->getTests() !== $this) {
            $test->setTests($this);
        }

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
            $patientSymptom->setPatient($this);
        }

        return $this;
    }

    public function removePatientSymptom(PatientSymptom $patientSymptom): self
    {
        if ($this->patientSymptoms->contains($patientSymptom)) {
            $this->patientSymptoms->removeElement($patientSymptom);
            // set the owning side to null (unless already changed)
            if ($patientSymptom->getPatient() === $this) {
                $patientSymptom->setPatient(null);
            }
        }

        return $this;
    }

    // TODO(aurel): Add date support.
    public function addSymptom(?Symptom $symptom/*, \DateTime $date*/): self {
        // TODO(aurel): check if already exists.
        //PatientSymptom $patientSymptom = new PatientSymptom();
        //$patientSymptom->setPatient($this);
        //$patientSymptom->setSymptom($symptom);

        return addPatientSymptom((new PatientSymptom())->setPatient($this)->setSymptom($symptom));
    }

    public function getSymptoms(): Collection {
        // TODO(aurel): Query for all symptoms.
        return new ArrayCollection();
    }

    public function removeSymptom(?Symptom $symptom): self {
        // TODO(aurel): Implement by querying for the right PatientSymptom and removing it.
        return $this;
    }

}
