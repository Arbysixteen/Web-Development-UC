<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Creates 75 products across 3 categories (enough for 5 pages with 15 products per page).
     */
    public function run(): void
    {
        // Clear existing products (disable FK checks for MySQL)
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Product::truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // 3 Categories: Frontend, Backend, Fullstack
        $categories = ['Frontend', 'Backend', 'Fullstack'];

        // Product templates for each category (25 products per category = 75 total)
        $productTemplates = [
            'Frontend' => [
                ['name' => 'Landing Page Premium', 'desc' => 'Template landing page modern dengan animasi smooth dan responsive design.'],
                ['name' => 'React Dashboard Template', 'desc' => 'Dashboard admin lengkap dengan charts, tables, dan dark mode.'],
                ['name' => 'Vue E-Commerce UI Kit', 'desc' => 'Komponen UI lengkap untuk membangun toko online modern.'],
                ['name' => 'Tailwind Component Library', 'desc' => 'Koleksi 100+ komponen siap pakai dengan Tailwind CSS.'],
                ['name' => 'Portfolio Website Template', 'desc' => 'Template portfolio elegan untuk developer dan designer.'],
                ['name' => 'Blog Theme Modern', 'desc' => 'Theme blog minimalis dengan fitur SEO optimized.'],
                ['name' => 'Mobile App UI Design', 'desc' => 'Desain UI/UX lengkap untuk aplikasi mobile iOS dan Android.'],
                ['name' => 'Bootstrap Admin Panel', 'desc' => 'Panel admin responsif dengan sidebar dan navbar modern.'],
                ['name' => 'Angular Material Dashboard', 'desc' => 'Dashboard berbasis Angular dengan Material Design.'],
                ['name' => 'Svelte Starter Kit', 'desc' => 'Starter template Svelte dengan routing dan state management.'],
                ['name' => 'Next.js Blog Template', 'desc' => 'Blog template menggunakan Next.js dengan SSG dan markdown support.'],
                ['name' => 'Nuxt.js E-Commerce', 'desc' => 'Template e-commerce lengkap dengan Nuxt.js dan Vue 3.'],
                ['name' => 'Astro Portfolio', 'desc' => 'Portfolio website super cepat dengan Astro framework.'],
                ['name' => 'SolidJS Admin', 'desc' => 'Admin dashboard reaktif dengan SolidJS dan Tailwind.'],
                ['name' => 'Qwik Landing Page', 'desc' => 'Landing page ultra-performant dengan Qwik framework.'],
                ['name' => 'HTMX Dashboard', 'desc' => 'Dashboard interaktif tanpa heavy JavaScript framework.'],
                ['name' => 'Alpine.js Components', 'desc' => 'Koleksi komponen UI ringan dengan Alpine.js.'],
                ['name' => 'Lit Element Library', 'desc' => 'Web components library dengan Lit Element.'],
                ['name' => 'Stencil Design System', 'desc' => 'Design system framework-agnostic dengan Stencil.'],
                ['name' => 'Preact Mini Dashboard', 'desc' => 'Dashboard ringan 3KB dengan Preact.'],
                ['name' => 'Remix Blog Starter', 'desc' => 'Blog starter dengan Remix dan PostgreSQL.'],
                ['name' => 'Gatsby Portfolio Pro', 'desc' => 'Portfolio profesional dengan Gatsby dan GraphQL.'],
                ['name' => 'Vite React Template', 'desc' => 'Template React super cepat dengan Vite bundler.'],
                ['name' => 'Ember.js Enterprise', 'desc' => 'Enterprise dashboard dengan Ember.js framework.'],
                ['name' => 'Stimulus Rails UI', 'desc' => 'UI components untuk Rails dengan Stimulus.'],
            ],
            'Backend' => [
                ['name' => 'Laravel REST API Boilerplate', 'desc' => 'Template API Laravel dengan auth, validation, dan dokumentasi.'],
                ['name' => 'Node.js Express Starter', 'desc' => 'Boilerplate Express.js dengan MongoDB dan JWT auth.'],
                ['name' => 'Django REST Framework Kit', 'desc' => 'API backend Python dengan Django dan PostgreSQL.'],
                ['name' => 'GraphQL API Server', 'desc' => 'Server GraphQL lengkap dengan subscription dan caching.'],
                ['name' => 'Microservices Template', 'desc' => 'Arsitektur microservices dengan Docker dan Kubernetes.'],
                ['name' => 'Payment Gateway Integration', 'desc' => 'Integrasi payment Midtrans, Xendit, dan Stripe.'],
                ['name' => 'Email Service Module', 'desc' => 'Modul email dengan queue, template, dan tracking.'],
                ['name' => 'Authentication System', 'desc' => 'Sistem auth lengkap dengan OAuth, 2FA, dan session.'],
                ['name' => 'File Storage Service', 'desc' => 'Service upload file dengan S3, Cloudinary integration.'],
                ['name' => 'Database Migration Tool', 'desc' => 'Tool migrasi database dengan backup dan rollback.'],
                ['name' => 'FastAPI Python Starter', 'desc' => 'API modern Python dengan FastAPI dan async support.'],
                ['name' => 'NestJS Enterprise API', 'desc' => 'API TypeScript enterprise-grade dengan NestJS.'],
                ['name' => 'Spring Boot Java API', 'desc' => 'REST API Java dengan Spring Boot dan JPA.'],
                ['name' => 'Go Fiber Microservice', 'desc' => 'Microservice ringan dengan Go Fiber framework.'],
                ['name' => 'Rust Actix Backend', 'desc' => 'Backend super performant dengan Rust Actix-web.'],
                ['name' => 'Elixir Phoenix API', 'desc' => 'Real-time API dengan Elixir Phoenix LiveView.'],
                ['name' => 'Ruby on Rails API', 'desc' => 'API mode Rails dengan ActiveRecord dan serializers.'],
                ['name' => 'ASP.NET Core API', 'desc' => 'Enterprise .NET API dengan Entity Framework Core.'],
                ['name' => 'Hapi.js Server', 'desc' => 'Server Node.js enterprise dengan Hapi.js.'],
                ['name' => 'Koa.js Middleware', 'desc' => 'Middleware-focused server dengan Koa.js.'],
                ['name' => 'AdonisJS Full API', 'desc' => 'Full-featured API dengan AdonisJS framework.'],
                ['name' => 'Strapi Headless CMS', 'desc' => 'Headless CMS backend dengan Strapi.'],
                ['name' => 'Directus Backend', 'desc' => 'Backend-as-a-Service dengan Directus.'],
                ['name' => 'Supabase Clone', 'desc' => 'Backend Supabase-like dengan PostgreSQL.'],
                ['name' => 'Prisma ORM Toolkit', 'desc' => 'Database toolkit dengan Prisma ORM.'],
            ],
            'Fullstack' => [
                ['name' => 'E-Commerce Platform Complete', 'desc' => 'Platform e-commerce lengkap dengan payment dan shipping.'],
                ['name' => 'SaaS Starter Kit', 'desc' => 'Template SaaS dengan subscription, billing, dan multi-tenant.'],
                ['name' => 'Social Media Clone', 'desc' => 'Clone media sosial dengan feed, stories, dan chat.'],
                ['name' => 'Learning Management System', 'desc' => 'Platform LMS dengan video course dan quiz system.'],
                ['name' => 'Project Management App', 'desc' => 'Aplikasi manajemen proyek dengan kanban dan timeline.'],
                ['name' => 'CRM System Complete', 'desc' => 'Sistem CRM dengan leads, deals, dan reporting.'],
                ['name' => 'Real Estate Platform', 'desc' => 'Platform properti dengan listing, search, dan maps.'],
                ['name' => 'Booking System', 'desc' => 'Sistem reservasi untuk hotel, restoran, atau salon.'],
                ['name' => 'Marketplace Multi-Vendor', 'desc' => 'Marketplace dengan multi seller dan commission system.'],
                ['name' => 'Healthcare Management', 'desc' => 'Sistem manajemen klinik dengan appointment dan EMR.'],
                ['name' => 'Food Delivery App', 'desc' => 'Aplikasi delivery makanan dengan tracking real-time.'],
                ['name' => 'Job Portal Platform', 'desc' => 'Platform lowongan kerja dengan ATS integration.'],
                ['name' => 'Event Management System', 'desc' => 'Sistem event dengan ticketing dan check-in QR.'],
                ['name' => 'Fitness Tracking App', 'desc' => 'Aplikasi fitness dengan workout plans dan progress.'],
                ['name' => 'Chat Application', 'desc' => 'Aplikasi chat real-time dengan WebSocket.'],
                ['name' => 'Video Streaming Platform', 'desc' => 'Platform streaming video seperti Netflix mini.'],
                ['name' => 'Music Player App', 'desc' => 'Aplikasi musik streaming dengan playlist.'],
                ['name' => 'News Portal CMS', 'desc' => 'Portal berita dengan CMS dan comment system.'],
                ['name' => 'Inventory Management', 'desc' => 'Sistem inventory dengan barcode dan reporting.'],
                ['name' => 'POS System', 'desc' => 'Point of Sale system untuk retail dan F&B.'],
                ['name' => 'HR Management System', 'desc' => 'HRIS dengan payroll, leave, dan attendance.'],
                ['name' => 'School Management', 'desc' => 'Sistem akademik sekolah dengan rapor online.'],
                ['name' => 'Hospital Management', 'desc' => 'Sistem rumah sakit dengan IGD dan farmasi.'],
                ['name' => 'Logistics Platform', 'desc' => 'Platform logistik dengan fleet management.'],
                ['name' => 'Banking App Clone', 'desc' => 'Aplikasi mobile banking dengan transfer dan history.'],
            ],
        ];

        // Create 75 products (25 per category)
        $id = 1;
        foreach ($categories as $category) {
            foreach ($productTemplates[$category] as $template) {
                Product::create([
                    'name' => $template['name'],
                    'description' => $template['desc'],
                    'price' => rand(150, 5000) * 1000, // Rp 150.000 - Rp 5.000.000
                    'category' => $category,
                    'image' => 'https://picsum.photos/seed/product' . $id . '/400/300',
                    'rating' => rand(35, 50) / 10, // 3.5 - 5.0
                    'sold' => rand(10, 500),
                ]);
                $id++;
            }
        }
    }
}
