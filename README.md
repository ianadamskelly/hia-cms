# Hilal International Academy CMS (HIA-CMS)

A modern, robust, and SEO-optimized Content Management System built for Hilal International Academy. 

Built with the latest **Laravel 12** and **Filament v5**, this platform empowers school administrators to manage everything from academic programmes and staff profiles to student inquiries and website SEO.

## ✨ Features

- **🎓 Academic Management**: Easy handling of programmes, campuses, and staff profiles.
- **📅 Events & News**: Dynamic management of school events (with upcoming/past filtering) and blog posts.
- **📄 Content Control**: Custom page creation and menu management for complete site flexibility.
- **📩 Lead Tracking**: Centralized dashboard for admission inquiries and contact form submissions.
- **🔍 SEO & URL Management**: Automated sitemap generation, Open Graph metadata integration, and a dedicated redirect system.
- **🛠️ Admin Panel**: A premium, high-performance interface powered by Filament v5.

## 🚀 Technical Stack

- **Framework**: [Laravel 12](https://laravel.com)
- **Admin Panel**: [Filament v5](https://filamentphp.com)
- **Frontend**: Blade Templates & Tailwind CSS v4
- **Database**: Eloquent ORM
- **Media Management**: Spatie Media Library
- **Testing**: Pest PHP v3

## 🛠️ Installation & Setup

1. **Clone the repository**:
    ```bash
    git clone https://github.com/ianadamskelly/hia-cms.git
    cd hia-cms
    ```

2. **Install PHP dependencies**:
    ```bash
    composer install
    ```

3. **Install JS dependencies**:
    ```bash
    npm install
    ```

4. **Environment Configuration**:
    Copy the example environment file and update your database and notification settings.
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

5. **Run Migrations & Seeders**:
    ```bash
    php artisan migrate --seed
    ```

6. **Start Development Server**:
    ```bash
    php artisan serve
    npm run dev
    ```

## 📈 Roadmap

- [ ] **Frontend Refinement**: Complete the responsive Blade template integration.
- [ ] **Site-wide Search**: Implement high-performance search functionality.
- [ ] **Image Optimization**: Automated resizing and compression for media assets.

---

*HIA-CMS is maintained by the Hilal International Academy team.*
