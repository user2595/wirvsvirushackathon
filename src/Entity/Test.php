<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TestRepository")
 */
class Test
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $result;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Patient", inversedBy="test", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $tests;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getResult(): ?bool
    {
        return $this->result;
    }

    public function setResult(bool $result): self
    {
        $this->result = $result;

        return $this;
    }

    public function getTests(): ?Patient
    {
        return $this->tests;
    }

    public function setTests(Patient $tests): self
    {
        $this->tests = $tests;

        return $this;
    }
}
