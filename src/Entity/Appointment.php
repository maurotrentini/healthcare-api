<?php

namespace App\Entity;

use App\Repository\AppointmentRepository;
use Doctrine\DBAL\Types\Types;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Link;
use ApiPlatform\Metadata\Get;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AppointmentRepository::class)]
#[ApiResource(
    uriTemplate: '/appointments/{appointmentId}/doctor',
    uriVariables: [
        'appointmentId' => new Link(fromClass: Appointment::class, fromProperty: 'doctor')
    ],
    operations: [new Get()]
)]
#[ApiResource]
class Appointment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $time = null;

    #[ApiSubresource]
    #[ORM\ManyToOne(inversedBy: 'appointments', targetEntity: Doctor::class)]
    private ?Doctor $doctor = null;

    #[ApiSubresource]
    #[ORM\ManyToOne(inversedBy: 'appointments', targetEntity: Patient::class)]
    private ?Patient $patient = null;

    #[ApiSubresource]
    #[ORM\ManyToOne(inversedBy: 'appointments', targetEntity: Clinic::class)]
    private ?Clinic $clinic = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTime
    {
        return $this->date;
    }

    public function setDate(\DateTime $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getTime(): ?\DateTime
    {
        return $this->time;
    }

    public function setTime(\DateTime $time): static
    {
        $this->time = $time;

        return $this;
    }

    public function getDoctor(): ?Doctor
    {
        return $this->doctor;
    }

    public function setDoctor(?Doctor $doctor): static
    {
        $this->doctor = $doctor;

        return $this;
    }

    public function getPatient(): ?Patient
    {
        return $this->patient;
    }

    public function setPatient(?Patient $patient): static
    {
        $this->patient = $patient;

        return $this;
    }

    public function getClinic(): ?Clinic
    {
        return $this->clinic;
    }

    public function setClinic(?Clinic $clinic): static
    {
        $this->clinic = $clinic;

        return $this;
    }
}
