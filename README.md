<p align="center">
  <img src="public/dist/img/caothang.png" alt="Cao Thắng Technical College logo" width="110">
</p>

<h1 align="center">Cao Thắng Management System</h1>

<p align="center">
  A full-featured college management platform for <strong>Cao Thắng Technical College</strong> — an AdminLTE-powered administration portal plus a token-secured REST API for student and lecturer clients, built on Laravel.
</p>

<p align="center">
  <img src="https://img.shields.io/badge/PHP-%E2%89%A5%208.0.2-777BB4?logo=php&logoColor=white" alt="PHP >= 8.0.2">
  <img src="https://img.shields.io/badge/Laravel-9.x-FF2D20?logo=laravel&logoColor=white" alt="Laravel 9">
  <img src="https://img.shields.io/badge/MySQL-Database-4479A1?logo=mysql&logoColor=white" alt="MySQL">
  <img src="https://img.shields.io/badge/Sanctum-3.x-FF2D20?logo=laravel&logoColor=white" alt="Laravel Sanctum">
  <img src="https://img.shields.io/badge/Vite-4-646CFF?logo=vite&logoColor=white" alt="Vite 4">
  <img src="https://img.shields.io/badge/AdminLTE-3-0073B7?logo=bootstrap&logoColor=white" alt="AdminLTE 3">
</p>

---

## Overview

This system digitizes the day-to-day academic operations of a technical college: faculties, departments, majors, curricula, classes, course sections, timetables, grading, graduation review, tuition, and online payments — all behind a role-aware admin portal. A separate Sanctum-authenticated REST API exposes student and lecturer workflows (timetables, grades, course registration, tuition payment, announcements) to client applications.

The scale is real, not a toy: **34 Eloquent models**, **58 migrations** (schema + foreign keys), **33 admin controllers**, **18 API controllers**, and 30+ CRUD modules in the admin UI.

> The domain model uses Vietnamese naming throughout (e.g. `SinhVien` = student, `GiangVien` = lecturer, `LopHocPhan` = course section, `HocPhi` = tuition fee).

## Features

### Admin portal (Blade + AdminLTE 3)

- **Academic catalog management** — faculties (*khoa*), departments (*bộ môn*), majors (*chuyên ngành*), subjects and subject types, rooms and room types.
- **Curriculum builder** — training programs (*chương trình đào tạo*) with per-semester detail lines, including a one-click **copy curriculum** action (`saoChepChiTiet`) to clone an existing program.
- **Class & course-section management** — classes (*lớp học*), course sections (*lớp học phần*) with section rosters and a roster-copy action that enrolls a whole class into a section.
- **Student records** — full CRUD plus **bulk import from Excel** (`maatwebsite/excel`, header row auto-detected at row 4), and on-the-fly generation of **student ID cards and name badges as images** (Intervention Image: canvas drawing, photo resize, college logo overlay).
- **Grade entry & graduation review** — lecturers enter component grades per section (*nhập điểm*); the graduation module (*xét tốt nghiệp*) computes per-semester GPA per class and filters candidates by faculty, major, or class.
- **Timetabling** — timetable (*thời khóa biểu*) and period-schedule (*thời gian biểu*) management with a **room/period conflict checker** (`kiemTraTrungPhongTrungTiet`) to prevent double-booked rooms.
- **Course registration windows** — open/close registration rounds per subject (*mở đăng ký môn*) and review student registrations.
- **Tuition management** — fee definitions (*học phí*), payment tracking, cancellation, and per-semester payment reports.
- **Role-based access control** — custom `checkchucvu` middleware gates route groups by position: Super administrator (1), Administrator (2), Lecturer (3); unauthorized users are redirected to a 403 page.
- **Soft delete & restore everywhere** — records are deactivated via a `trang_thai` status flag; every module has an "inactive data" view and a restore action instead of destructive deletes.
- **Audit trail** — `spatie/laravel-activitylog` records changes (registration windows, payments, grade changes…), browsable in an admin Activity Log screen joined to the acting lecturer.
- **Auth & account recovery** — session login for staff with email-based password reset via Laravel's password broker.
- **Dashboard** — headline counts of students, lecturers, faculties, and majors.

### REST API (Laravel Sanctum)

- **Separate login flows** for students (`POST /api/login-sinh-vien`) and lecturers (`POST /api/login-giang-vien`) issuing Sanctum bearer tokens, plus logout and session-check endpoints.
- **Student endpoints** — personal timetable (by curriculum and by registered sections), grade sheets per semester, full academic history (*quá trình học tập*), notifications with read-state tracking, tuition list/details, and password change.
- **Self-service course registration** — eligibility check against the open registration window, list open sections per subject, register/cancel a section, and detect duplicate-subject registrations.
- **Online tuition payment** — payment capture endpoints for **PayPal** and **VNPay** (sandbox): the PayPal handler verifies an HMAC-SHA256 signature over the payload, the VNPay handler validates `vnp_SecureHash` and guards against replayed transactions; successful payments are persisted (`paypal_payments` / `vnpay_payments`) and linked to the tuition or section-registration record.
- **Lecturer endpoints** — teaching schedule, assigned and completed course sections, homeroom classes with student rosters, section gradebooks with grade updates, and announcement CRUD targeted at course sections.

## Tech stack

| Layer | Technology |
|---|---|
| Framework | [Laravel 9](https://laravel.com) (`laravel/framework` ^9.19, locked at v9.52) on PHP ≥ 8.0.2 |
| API auth | [Laravel Sanctum](https://laravel.com/docs/9.x/sanctum) ^3.2 (token-based) |
| Database | MySQL (Eloquent ORM, 58 migrations with FK constraints, seeders & factories) |
| Admin UI | Blade templates + AdminLTE 3 (Bootstrap 4, DataTables, Chart.js, Select2 — bundled in `public/dist` / `public/plugins`) |
| Asset pipeline | Vite 4 + `laravel-vite-plugin`, Axios, Lodash |
| Excel import | `maatwebsite/excel` ^3.1 |
| Image generation | `intervention/image` ^2.7 (student ID cards, name badges) |
| Audit logging | `spatie/laravel-activitylog` ^4.7 |
| HTTP client | Guzzle ^7.2 |
| Dev tooling | PHPUnit ^9.5, Laravel Pint, Laravel Sail, Faker, `kitloong/laravel-migrations-generator` |

## Getting started

### Prerequisites

- PHP ≥ 8.0.2 with the **GD** extension (required by Intervention Image)
- Composer
- MySQL
- Node.js 16+ and npm

### Installation

```bash
# 1. Clone
git clone https://github.com/DucMinhNe/CaoThangManagementSystem.git
cd CaoThangManagementSystem

# 2. PHP dependencies
composer install

# 3. Environment config
cp .env.example .env
php artisan key:generate

# 4. Create the database, then migrate and seed
mysql -u root -e "CREATE DATABASE ems_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
php artisan migrate
php artisan db:seed   # seeds roles, sample lecturers and students

# 5. Front-end assets
npm install
npm run dev      # or: npm run build

# 6. Serve
php artisan serve
```

The admin portal lives at `http://localhost:8000/admin` (login at `/admin/dangnhap`); the REST API is rooted at `http://localhost:8000/api`.

> **Notes**
> - `.env.example` targets a local MySQL database named `ems_db` (user `root`, empty password) — adjust `DB_*` to your environment after copying it to `.env`.
> - To test online tuition payment, put your own **sandbox** credentials in `.env`: the PayPal REST app client ID/secret go in `PAYPAL_SANDBOX_CLIENT_ID` / `PAYPAL_SANDBOX_CLIENT_SECRET` (with `PAYPAL_MODE=sandbox`), and the VNPay merchant code and hash secret go in `VNP_TMNCODE` / `VNP_HASHSECRET`.
> - Password-reset emails default to a local MailHog SMTP config (`MAIL_HOST=mailhog`, port 1025).
> - Generated student photos, ID cards, and name badges are written to `public/sinhvien_img`, `public/sinhvien_thesinhvien`, and `public/sinhvien_bangten`.

## Project structure

```
.
├── app/
│   ├── Http/
│   │   ├── Controllers/        # 33 admin controllers (CRUD modules, grading, graduation, payments…)
│   │   │   └── api/            # 18 API controllers for student & lecturer clients
│   │   └── Middleware/         # CheckChucVu — role-based route guard
│   ├── Imports/                # SinhViensImport — Excel → student records
│   └── Models/                 # 34 Eloquent models (SinhVien, GiangVien, LopHocPhan, HocPhi…)
├── config/                     # Laravel config incl. activitylog.php, excel.php, sanctum.php
├── database/
│   ├── migrations/             # 58 migrations: tables + foreign-key passes
│   └── seeders/                # roles, lecturers, students, catalog seed data
├── lang/                       # localization
├── public/
│   ├── dist/ & plugins/        # AdminLTE 3 theme + JS plugins (DataTables, Chart.js…)
│   └── sinhvien_*/             # generated student photos, ID cards, name badges
├── resources/views/admin/      # 30+ Blade module folders + shared layouts
├── routes/
│   ├── web.php                 # admin portal routes (auth + role middleware groups)
│   └── api.php                 # Sanctum-protected student/lecturer API
└── tests/                      # PHPUnit feature & unit scaffolding
```

## How it works

```
        Browser (staff)                       Student / Lecturer clients
              │                                          │
              ▼                                          ▼
   Blade + AdminLTE portal  ◄─── Laravel 9 ───►   REST API (/api/*)
        session auth                              Sanctum bearer tokens
              │                                          │
   CheckChucVu middleware                    role-scoped route groups
   (super admin / admin / lecturer)        (student vs lecturer flows)
              │                                          │
              └────────────► MySQL (ems_db) ◄────────────┘
                  34 models · FK-enforced schema
                  trang_thai soft-delete + restore
                  spatie activity log audit trail
```

- **Two front doors, one domain layer.** Staff use the server-rendered admin portal (session auth); students and lecturers consume the JSON API (Sanctum tokens). Both share the same Eloquent models and MySQL schema.
- **Authorization by position.** Authentication is backed by the `GiangVien` (lecturer) model; the `CheckChucVu` middleware reads the user's position ID and gates entire route groups (`checkchucvu:1|2` for admin modules, `checkchucvu:1` for super-admin-only modules).
- **Payments are verified, not trusted.** PayPal captures are checked with an HMAC-SHA256 signature; VNPay callbacks are validated against `vnp_SecureHash` with duplicate-transaction detection before any tuition record is marked paid.
- **Nothing is hard-deleted.** Every module flips a `trang_thai` flag and offers an inactive-records view with restore, keeping historical data intact for the activity log.
