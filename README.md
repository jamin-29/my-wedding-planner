# My Wedding Planner

Modern wedding planning portal with a client-facing experience and an admin back-office for managing bookings, packages, services, and galleries.

## Table of Contents

1. [Overview](#overview)
2. [Features](#features)
3. [Tech Stack](#tech-stack)
4. [Project Structure](#project-structure)
5. [Getting Started](#getting-started)
6. [Environment Variables](#environment-variables)
7. [Docker Workflow](#docker-workflow)
8. [Usage Guide](#usage-guide)
9. [Deployment Notes](#deployment-notes)
10. [Future Enhancements](#future-enhancements)

## Overview

My Wedding Planner helps couples browse curated packages, book services, and stay in touch with planners, while giving administrators full control over bookings, packages, and website content. The project ships with ready-to-run PHP pages, MySQL database schema dumps, Docker assets, and front-end styling.

## Features

- **Authenticated client portal** – gated access to the main site (`index.php`) ensures only logged-in clients can browse, book, and manage their details.
- **Booking workflow** – logged-in clients can submit booking requests with preferred services, packages, and event details. Confirmation and validation messaging are built in.
- **Packages & services showcase** – responsive sections highlight curated packages and service offerings with pricing cues for easy browsing.
- **Gallery and content pages** – prebuilt About, Gallery, and Contact pages for storytelling and lead capture.
- **Admin dashboard** – administrators can manage bookings, packages, services, users, messages, and gallery content from dedicated modules in `/admin`.
- **MySQL-backed persistence** – schema and seed data are included via `wedding_planner.sql` for quick setup.
- **Docker & local scripts** – run the stack via Docker Compose or PHP’s built-in server (`npm run start`).

## Tech Stack

- **Backend:** PHP 8.2, mysqli extension
- **Database:** MySQL 8
- **Frontend:** HTML5, CSS3, Font Awesome icons
- **Runtime/Tooling:** XAMPP / Apache, PHP built-in server, Docker & Docker Compose

## Project Structure

```
My_Wedding_Planner/
├── admin/                 # Admin dashboard pages & styles
├── api/                   # API endpoints (if any future integrations)
├── assets/                # CSS, images, fonts
├── includes/              # Shared snippets (DB connect, header, footer, auth helpers)
├── *.php                  # Client-facing pages (home, services, packages, gallery, etc.)
├── Dockerfile             # PHP 8.2 Apache image
├── docker-compose.yml     # Web + MySQL services
├── package.json           # Convenience script to run PHP server locally
├── wedding_planner.sql    # Database schema & seed data
└── .env.example           # Sample environment configuration
```

## Getting Started

### 1. Prerequisites

- PHP ≥ 8.1 with `mysqli`
- MySQL ≥ 8.0 (or MariaDB equivalent)
- Composer (optional) if you plan to add dependencies
- Node.js (optional) for the npm start helper
- Docker & Docker Compose (optional) for containerized runs

### 2. Clone & Install

```bash
git clone https://github.com/<your-org>/My_Wedding_Planner.git
cd My_Wedding_Planner
```

Install Node helper scripts (optional):

```bash
npm install
```

### 3. Configure Environment

Create a `.env` file based on `.env.example`:

```bash
cp .env.example .env
# adjust DB credentials as needed
```

Update `includes/db_connect.php` if your local credentials differ from the defaults shipped for XAMPP/MAMP.

### 4. Database Setup

1. Create a database named `wedding_planner` (or match your `.env`).
2. Import `wedding_planner.sql` via phpMyAdmin, MySQL Workbench, or CLI:

   ```bash
   mysql -u root -p wedding_planner < wedding_planner.sql
   ```

### 5. Run Locally

**Option A – Apache/XAMPP:**
- Place the project inside `htdocs` (already assumed) and visit `http://localhost/My_Wedding_Planner`.

**Option B – PHP built-in server:**

```bash
npm run start
# or
php -S 0.0.0.0:8000 -t .
```

Visit `http://localhost:8000`.

## Environment Variables

| Variable  | Description                | Default (dev) |
|-----------|----------------------------|---------------|
| `DB_HOST` | Database host/name or host | `db` (Docker) |
| `DB_NAME` | Database name              | `wedding_planner` |
| `DB_USER` | Database username          | `root`        |
| `DB_PASS` | Database password          | `password` (Docker) / empty for XAMPP |
| `DB_PORT` | Database port              | `3306`        |

> Note: `includes/db_connect.php` defaults to `localhost`, `root`, and empty password. Update those values or load env vars via your preferred method.

## Docker Workflow

1. Ensure Docker Desktop is running.
2. Copy `.env.example` to `.env` (Docker Compose reads values from `docker-compose.yml`).
3. Build & start services:

   ```bash
   docker-compose up --build
   ```

4. Access the app at `http://localhost:8080` and MySQL at `localhost:3306`.
5. Stop containers with `docker-compose down` (add `-v` to remove the persisted volume).

## Usage Guide

- **Client flow**
  1. Register or log in via `signup.php` / `login.php`.
  2. Browse services and packages from the navigation bar.
  3. Submit bookings via `book_now.php` (all inputs validated, success/error banners displayed).
  4. Update profile information through `profile.php` / `update_profile.php`.

- **Admin flow**
  1. Log in via `/admin/admin_login.php`.
  2. Access cards on `admin/admin_dashboard.php` to manage bookings, services, packages, users, messages, and gallery content.
  3. Each management page includes CRUD forms, pagination, and delete confirmations.

## Deployment Notes

- **Docker-based hosting** – push the image built from `Dockerfile` to a registry and run it behind your preferred platform (Render, AWS ECS, DigitalOcean, etc.). Expose port 80/8080 and provide the MySQL connection string through environment variables.
- **Traditional LAMP hosting** – upload the repo to your server’s `public_html`, ensure PHP ≥ 8.1, import the database, and set env/connection values.
- **Render & Wasmer** – sample manifests (`render.yaml`, `wasmer.toml`) are included as starting points. Update service names, regions, and secrets before deploying.

## Future Enhancements

- Add email notifications after bookings.
- Implement role-based access controls for staff vs. super admin.
- Replace static selects with dynamic data from the `services`/`packages` tables.
- Add automated tests (PHPUnit) and CI workflows.
- Document admin default credentials once finalized.

---

Need extra guidance or want to contribute improvements? Open an issue or start a discussion in the repository.
