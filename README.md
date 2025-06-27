# Healthcare API

A Symfony 7 REST API for managing healthcare clinics, doctors, patients, and appointments—fully Dockerized for easy setup.

## Stack
- Symfony 7
- Docker
- MySQL
- API Platform

🚀 Quick Start

## Prerequisites

Docker & Docker Compose installed (Windows, macOS, Linux)

Git (to clone the repo)

## Clone the Repository

git clone https://github.com/maurotrentini/healthcare-api.git
cd healthcare-api

## 1. Build & Run Containers

This will build the Symfony backend, MySQL database, and phpMyAdmin:

docker-compose up -d --build

Symfony API: http://localhost:8000

Swagger UI / API Docs: http://localhost:8000/docs

phpMyAdmin: http://localhost:8080 (user: symfony, password: symfony)

## 2. Run Database Migrations

Run the following to generate your database schema:

docker exec -it healthcare_api php bin/console doctrine:migrations:migrate

## 3. (Optional) Load Mock Data

Seed the database with randomized mock data:

docker exec -it healthcare_api php bin/console doctrine:fixtures:load

Note: Fixtures use Faker with a fixed seed for repeatable data. You can customize src/DataFixtures/AppFixtures.php.

## 4. Test the API

List clinics: GET http://localhost:8000/clinics

List doctors: GET http://localhost:8000/doctors

Get doctor’s appointments: GET http://localhost:8000/doctors/{id}/appointments

List appointments: GET http://localhost:8000/appointments

## 5. Stop Containers

To free resources when you’re done:

docker-compose down

## 🧱 Project Structure

/ ── Dockerfile
    ── docker-compose.yml
    ── .gitignore
    ── README.md
    └─ src/
        ├─ Entity/
        ├─ Controller/
        ├─ DataFixtures/
        ├─ Repository/
        └─ ...

## 💡 Tips

**Environment**: You can adjust database credentials in docker-compose.yml and Symfony’s .env.

**Adding Entities**: Use php bin/console make:entity inside the container.

**Generating Migrations**: php bin/console make:migration

**Clearing Cache**: php bin/console cache:clear

## 📄 License

MIT © Mauro Trentini


