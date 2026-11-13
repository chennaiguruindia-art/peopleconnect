# விருதுநகர் மக்கள் குரல் (குரலற்ற மகளின் குரல்)
### Bilingual Public Grievance Management Portal for Virudhunagar District, குரலற்ற மகளின் குரல்

[![Laravel](https://img.shields.io/badge/Laravel-12.x-red.svg)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-blue.svg)](https://php.net)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-purple.svg)](https://getbootstrap.com)
[![MySQL](https://img.shields.io/badge/Database-MySQL-orange.svg)](https://mysql.com)

---

## 🏛️ Project Overview

**குரலற்ற மகளின் குரல்** (விருதுநகர் மக்கள் குரல்) is a production-ready, bilingual (Tamil & English) civic grievance redressal and tracking web portal built exclusively using **Laravel Blade**, **Bootstrap 5**, **jQuery AJAX**, and **MySQL**.

> **Civic Initiative Notice**: குரலற்ற மகளின் குரல் is an independent, non-governmental civic-service portal designed to bridge citizens with public administration across all 10 Taluks of Virudhunagar District. It does not falsely claim official government affiliation.

---

## 🎨 Branding & Design System

- **Website Name**: குரலற்ற மகளின் குரல் (விருதுநகர் மக்கள் குரல்)
- **Tagline**: *Your Voice, Your Community, Your Development.* (மக்களின் குரல், மக்களின் கோரிக்கை.)
- **Primary Color**: Civic Saffron / Orange (`#e65100`)
- **Secondary Color**: Deep Civic Green (`#1b5e20`)
- **Backgrounds**: Clean White (`#ffffff`) & Subtle Slate (`#f8fafc`)
- **Typography**: Dual-font stack featuring `Mukta Malar` (Tamil) and `Plus Jakarta Sans` (English).

---

## 🚀 Key Features

1. **100% Laravel Blade & jQuery Architecture**:
   - Single, unified Laravel application.
   - Zero React, Vue, or separate frontend frameworks.
   - Pure Blade templates with component inheritance.
   - Smooth jQuery AJAX for dynamic dependent dropdowns, OTP verification, grievance filing, and live tracking.

2. **Official Revenue & Disaster Management Setup (Per Government Master Dataset)**:
   - **3 Revenue Divisions**:
     1. **Sivakasi Division**: Sivakasi, Srivilliputtur, Watrap.
     2. **Aruppukottai Division**: Virudhunagar, Aruppukottai, Tiruchuli, Kariapatti.
     3. **Sattur Division**: Rajapalayam, Sattur, Vembakkottai.
   - **10 Revenue Taluks & 39 Firkas**:
     - *Aruppukottai Taluk* (5 Firkas, 83 Villages)
     - *Kariapatti Taluk* (4 Firkas, 107 Villages)
     - *Rajapalayam Taluk* (4 Firkas, 32 Villages)
     - *Sattur Taluk* (4 Firkas, 53 Villages)
     - *Sivakasi Taluk* (4 Firkas, 36 Villages)
     - *Srivilliputhur Taluk* (3 Firkas, 26 Villages)
     - *Tiruchuli Taluk* (4 Firkas, 150 Villages)
     - *Vembakkottai Taluk* (4 Firkas, 37 Villages)
     - *Virudhunagar Taluk* (4 Firkas, 53 Villages)
     - *Watrap Taluk* (3 Firkas, 23 Villages)
   - **Total 600 Revenue Villages** precisely mapped with their corresponding Firka.
   - **Urban & Rural Local Bodies**: Sivakasi City Corporation, 5 Municipalities, 9 Town Panchayats, and 11 Development Blocks.

3. **Multi-Section Grievance Registration Form**:
   - **Section 1**: Citizen Details (Full Name, 10-digit Mobile Number, Email, Street Address).
   - **Section 2**: Location Details (District, Revenue Division, Taluk, Revenue Village, Ward No., Landmark).
   - **Section 3**: Issue Specifics (Category, Subject, Priority, Detailed Description).
   - **Section 4**: Attachments (Site photographs, petition documents up to 5MB).
   - **Section 5**: Privacy and truthfulness consent with OTP verification.
   - Generates unique ID format: `VNK-YYYYMMDD-XXXX`.
   - Asynchronous FormData submission with loading spinner and zero page reloads.

4. **Real-Time Grievance Tracking**:
   - Citizen enters Grievance ID + registered mobile number.
   - Instant AJAX retrieval showing current status, assigned nodal officer, department referral communication, and full status history audit timeline.
   - **Citizen Privacy Guaranteed**: Private phone numbers and personal documents are masked/hidden on public views.

5. **Executive Admin Dashboard & Operations**:
   - Accessible at `/admin` (protected by `admin.auth` role-based middleware).
   - **Live Metrics**: Total, Submitted, Under Review, Awaiting Info, In Progress, Referred, Resolved, Rejected.
   - **Interactive Chart.js Visualizations** (fetched via AJAX from MySQL):
     - Monthly complaints trend.
     - Category-wise distribution.
     - Taluk-wise volume across 10 taluks.
     - Status breakdown.
   - **Action Workflow**:
     - Assign grievances to staff/officers.
     - Change status with mandatory remarks and resolution photo upload.
     - Record official Department Referrals (tracked separately without premature closure).
     - Export complaints to Excel/CSV with Tamil UTF-8 BOM encoding.
     - Master data CRUD for locations, categories, staff, updates, and settings.

6. **Bilingual Localization (Tamil Default & English)**:
   - Laravel `lang/ta/messages.php` and `lang/en/messages.php`.
   - Session-persisted language toggle in header and admin panel (`/lang/{locale}`).

---

## 📂 Project Directory Structure

```
resources/views/
├── layouts/
│   ├── app.blade.php           # Public Blade layout with Bootstrap 5
│   └── admin.blade.php         # Admin dashboard layout
├── components/
│   ├── header.blade.php        # Branding header with disclaimer & helpline
│   ├── footer.blade.php        # 4-column footer & emergency directory
│   ├── navbar.blade.php        # Navigation menu with active highlighting
│   ├── language-switcher.blade.php # Tamil/English dropdown
│   └── alerts.blade.php        # Flash message alerts
├── public/
│   ├── home.blade.php          # Homepage with live stats & categories
│   ├── about.blade.php         # Mission, vision, core pillars
│   ├── submit-complaint.blade.php # Multi-section AJAX form
│   ├── track-complaint.blade.php  # Asynchronous grievance tracking
│   ├── public-issues.blade.php # Filterable public grievance board
│   ├── district-information.blade.php # 10 Taluks & Urban directory
│   ├── updates.blade.php       # Civic bulletins & alerts
│   ├── contact.blade.php       # Facilitation cell & emergency numbers
│   ├── privacy-policy.blade.php # Citizen data protection policy
│   └── terms-conditions.blade.php # Usage terms & truthfulness rules
└── admin/
    ├── auth/login.blade.php    # Secure admin sign-in
    ├── dashboard.blade.php     # Chart.js analytics & metric cards
    ├── complaints/
    │   ├── index.blade.php     # Filterable complaints table
    │   ├── show.blade.php      # Complaint dossier, assign & status modals
    │   └── partials/table.blade.php
    ├── locations/              # Revenue village CRUD
    ├── categories/             # Grievance category & SLA CRUD
    ├── staff/                  # Nodal officer & staff CRUD
    ├── reports/                # Performance analytics & breakdown
    ├── updates/                # Public bulletins CRUD
    └── settings/               # System & portal configuration
```

---

## 🛠️ Installation & Setup

### Prerequisites
- PHP 8.2 or higher (with `pdo_mysql`, `mbstring`, `fileinfo`, `openssl`)
- MySQL 8.0 or MariaDB 10.4+
- Composer

### Setup Steps

1. **Configure Environment (`.env`)**:
   ```env
   APP_NAME="குரலற்ற மகளின் குரல்"
   APP_ENV=local
   APP_DEBUG=true
   APP_URL=http://localhost:8000
   APP_LOCALE=ta
   APP_FALLBACK_LOCALE=en

   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=vote
   DB_USERNAME=root
   DB_PASSWORD=
   ```

2. **Run Migrations & Seeders**:
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

3. **Start the Laravel Server**:
   ```bash
   php artisan serve
   ```

4. **Access the Portal**:
   - **Public Website**: `http://localhost:8000`
   - **Admin Portal**: `http://localhost:8000/admin`

---

## 🔑 Default Credentials

| Role | Email | Password | Access |
|---|---|---|---|
| **Super Admin** | `admin@virudhunagar.org` | `password123` | Full administrative control |
| **Grievance Officer (Water)** | `ramanathan@virudhunagar.org` | `password123` | Grievance actions & inspections |
| **Grievance Officer (Sanitation)** | `subbalakshmi@virudhunagar.org` | `password123` | Grievance actions & inspections |
| **Grievance Officer (Roads)** | `murugesan@virudhunagar.org` | `password123` | Grievance actions & inspections |

---

## 🧪 Testing

Run the feature test suite:
```bash
php artisan test --filter=PortalEndpointsTest
```
All endpoints—including public routes, dependent location AJAX, OTP verification, grievance filing, tracking, admin workflows, and session locale persistence—are covered.
#   p e o p l e c o n n e c t  
 