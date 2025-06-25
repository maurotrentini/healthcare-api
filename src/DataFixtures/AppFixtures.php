<?php

namespace App\DataFixtures;

use App\Entity\Clinic;
use App\Entity\Doctor;
use App\Entity\Patient;
use App\Entity\Appointment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        $faker->seed(2025); // Repeatable seed for consistent results

        $specialties = [
            'General Practitioner',
            'Cardiologist',
            'Dermatologist',
            'Endocrinologist',
            'Gynecologist',
            'Neurologist',
            'Oncologist',
            'Orthopedic Surgeon',
            'Pediatrician',
            'Psychiatrist',
            'Physiotherapist',
            'Radiologist',
            'Urologist',
        ];

        $clinics = [];
        for ($i = 0; $i < 5; $i++) {
            $clinic = new Clinic();
            $clinic->setName($faker->company . ' Clinic');
            $clinic->setAddress($faker->address);
            $manager->persist($clinic);
            $clinics[] = $clinic;
        }

        $doctors = [];
        for ($i = 0; $i < 10; $i++) {
            $doctor = new Doctor();
            $doctor->setFirstName($faker->firstName);
            $doctor->setLastName($faker->lastName);
            $doctor->setSpecialty($faker->randomElement($specialties));
            $doctor->setClinic($faker->randomElement($clinics));
            $manager->persist($doctor);
            $doctors[] = $doctor;
        }

        $patients = [];
        for ($i = 0; $i < 20; $i++) {
            $patient = new Patient();
            $patient->setFirstName($faker->firstName);
            $patient->setLastName($faker->lastName);
            $patient->setDateOfBirth($faker->dateTimeBetween('-90 years', '-1 years'));
            $manager->persist($patient);
            $patients[] = $patient;
        }

        for ($i = 0; $i < 30; $i++) {
            $appointment = new Appointment();
            $appointment->setDate($faker->dateTimeBetween('now', '+1 month'));
            $appointment->setTime($faker->dateTimeBetween('08:00:00', '18:00:00'));
            $appointment->setDoctor($faker->randomElement($doctors));
            $appointment->setPatient($faker->randomElement($patients));
            $appointment->setClinic($faker->randomElement($clinics));
            $manager->persist($appointment);
        }

        $manager->flush();
    }
}
