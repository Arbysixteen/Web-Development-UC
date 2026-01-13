<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the homepage.
     */
    public function index()
    {
        // Featured products
        $featuredProducts = collect(range(1, 6))->map(function ($i) {
            $categories = ['Frontend', 'Backend', 'Fullstack'];
            $names = [
                'Landing Page Development',
                'E-Commerce Website',
                'REST API Development',
                'Full Stack Web App',
                'Admin Dashboard',
                'Portfolio Website'
            ];
            
            return (object) [
                'id' => $i,
                'name' => $names[$i - 1] ?? 'Product ' . $i,
                'description' => 'Professional development service with modern technologies.',
                'price' => rand(500, 3000) * 1000,
                'category' => $categories[array_rand($categories)],
                'image' => 'https://picsum.photos/seed/featured' . $i . '/400/300',
                'rating' => rand(40, 50) / 10,
                'sold' => rand(50, 200),
            ];
        });

        // Services offered
        $services = [
            (object) [
                'icon' => 'bi-laptop',
                'title' => 'Frontend Development',
                'description' => 'Beautiful and responsive user interfaces using React, Vue, or vanilla JavaScript.',
                'price_start' => 500000,
            ],
            (object) [
                'icon' => 'bi-server',
                'title' => 'Backend Development',
                'description' => 'Robust APIs and server-side applications with Laravel, Node.js, or Python.',
                'price_start' => 750000,
            ],
            (object) [
                'icon' => 'bi-stack',
                'title' => 'Fullstack Development',
                'description' => 'Complete web solutions from database to user interface.',
                'price_start' => 1500000,
            ],
        ];

        // Testimonials
        $testimonials = [
            (object) [
                'name' => 'Ahmad Rizki',
                'role' => 'CEO, TechStartup',
                'content' => 'Excellent service! The website they built exceeded our expectations.',
                'avatar' => 'https://i.pravatar.cc/100?img=1',
            ],
            (object) [
                'name' => 'Sarah Putri',
                'role' => 'Marketing Manager',
                'content' => 'Professional and timely delivery. Highly recommended!',
                'avatar' => 'https://i.pravatar.cc/100?img=5',
            ],
            (object) [
                'name' => 'Budi Santoso',
                'role' => 'Entrepreneur',
                'content' => 'Great communication and the final product was amazing.',
                'avatar' => 'https://i.pravatar.cc/100?img=3',
            ],
        ];

        return view('home', compact('featuredProducts', 'services', 'testimonials'));
    }
}
