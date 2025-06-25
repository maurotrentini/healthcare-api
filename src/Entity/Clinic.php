<?php

namespace App\Entity;

use App\Repository\ClinicRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Link;

#[ORM\Entity(repositoryClass: ClinicRepository::class)]
#[ApiResource(
    uriTemplate: '/appointments/{appointmentId}/clinic',
    uriVariables: [
        'appointmentId' => new Link(fromClass: Appointment::class, fromProperty: 'clinic')
    ],
    operations: [new Get()]
)]
#[ApiResource(
    operations: [
        new GetCollection(),   // GET /clinics
        new Post(),            // POST /clinics
        new Get(),             // GET /clinics/{id}
        new Patch(),           // PATCH /clinics/{id}
        new Delete(),          // DELETE /clinics/{id}
        new GetCollection(
            uriTemplate: '/clinics/{id}/doctors',
            uriVariables: [
                'id' => new Link(fromClass: Doctor::class, fromProperty: 'clinic')
            ],
            normalizationContext: ['groups' => ['clinic:doctors:read']]
        ),
        new GetCollection(
            uriTemplate: '/clinics/{id}/appointments',
            uriVariables: [
                'id' => new Link(fromClass: Appointment::class, fromProperty: 'clinic')
            ],
            normalizationContext: ['groups' => ['clinic:appointments:read']]
        ),
    ]
)]
class Clinic
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type:"integer")]
    #[Groups(['clinic:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    #[Groups(['clinic:read','clinic:write'])]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['clinic:read','clinic:write'])]
    private ?string $address = null;

    #[ApiSubresource]
    #[ORM\OneToMany(mappedBy: 'clinic', targetEntity: Doctor::class)]
    private Collection $doctors;

    #[ApiSubresource]
    #[ORM\OneToMany(mappedBy: 'clinic', targetEntity: Appointment::class)]
    private Collection $appointments;

    public function __construct()
    {
        $this->doctors = new ArrayCollection();
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

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): static
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return Collection<int, Doctor>
     */
    public function getDoctors(): Collection
    {
        return $this->doctors;
    }

    public function addDoctor(Doctor $doctor): static
    {
        if (!$this->doctors->contains($doctor)) {
            $this->doctors[] = $doctor;
            $doctor->setClinic($this);
        }

        return $this;
    }

    public function removeDoctor(Doctor $doctor): static
    {
        if ($this->doctors->removeElement($doctor)) {
            // Set the owning side to null (unless already changed)
            if ($doctor->getClinic() === $this) {
                $doctor->setClinic(null);
            }
        }

        return $this;
    }

    // Getter
    /**
     * @return Collection<int, Appointment>
     */
    public function getAppointments(): Collection
    {
        return $this->appointments;
    }

    // Adder
    public function addAppointment(Appointment $appointment): static
    {
        if (!$this->appointments->contains($appointment)) {
            $this->appointments[] = $appointment;
            $appointment->setClinic($this);
        }

        return $this;
    }

    // Remover
    public function removeAppointment(Appointment $appointment): static
    {
        if ($this->appointments->removeElement($appointment)) {
            if ($appointment->getClinic() === $this) {
                $appointment->setClinic(null);
            }
        }

        return $this;
    }
}
