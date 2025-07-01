# 🏥 Healthcare API

A **Symfony 7 REST API** for managing healthcare clinics, doctors, patients, and appointments — fully Dockerized for easy setup and development.

---

## ⚙️ Tech Stack

-   **Symfony 7**
-   **API Platform** (Hydra-compliant REST API)
-   **MySQL**
-   **Docker & Docker Compose**
-   **phpMyAdmin**

---

## 🚀 Quick Start

### ✅ Prerequisites

Make sure you have:

-   [Docker & Docker Compose](https://docs.docker.com/get-docker/) installed
-   [Git](https://git-scm.com/) installed

---

### 📦 Clone the Repository

```bash
git clone https://github.com/maurotrentini/healthcare-api.git
cd healthcare-api
```

---

### 🛠️ 1. Build & Run Containers

This will start the Symfony API, MySQL, and phpMyAdmin:

```bash
docker-compose up -d --build
```

-   **Symfony API**: [http://localhost:8000](http://localhost:8000)
-   **Swagger UI / API Docs**: [http://localhost:8000/docs](http://localhost:8000/docs)
-   **phpMyAdmin**: [http://localhost:8080](http://localhost:8080)

    -   _Username_: `symfony`
    -   _Password_: `symfony`

---

### 🗃️ 2. Run Database Migrations

Generate the database schema:

```bash
docker exec -it healthcare_api php bin/console doctrine:migrations:migrate
```

---

### 🧪 3. (Optional) Load Mock Data

Seed the database with fake but realistic data:

```bash
docker exec -it healthcare_api php bin/console doctrine:fixtures:load
```

> Fixtures use [Faker](https://fakerphp.dev/) with a fixed seed. You can customize the data inside `src/DataFixtures/AppFixtures.php`.

---

### 🔍 4. Test the API

Example endpoints:

-   `GET /api/clinics` → List clinics
-   `GET /api/doctors` → List doctors
-   `GET /api/doctors/{id}/appointments` → Appointments for a doctor
-   `GET /api/appointments` → List appointments

Use Swagger UI at [`/docs`](http://localhost:8000/docs) for exploration and testing.

---

### 🛑 5. Stop Containers

```bash
docker-compose down
```

---

## 🧱 Project Structure

```
/healthcare-api
├── docker-compose.yml
├── Dockerfile
├── .env
├── README.md
└── src/
    ├── Controller/
    ├── DataFixtures/
    ├── Entity/
    ├── Repository/
    └── ...
```

---

## 💡 Developer Tips

-   **Edit env vars** in `.env` or `docker-compose.yml`
-   **Make a new entity**:

    ```bash
    docker exec -it healthcare_api php bin/console make:entity
    ```

-   **Run migrations**:

    ```bash
    docker exec -it healthcare_api php bin/console make:migration
    docker exec -it healthcare_api php bin/console doctrine:migrations:migrate
    ```

-   **Clear cache**:

    ```bash
    docker exec -it healthcare_api php bin/console cache:clear
    ```

---

## 📄 License

MIT © [Mauro Trentini](https://github.com/maurotrentini)
