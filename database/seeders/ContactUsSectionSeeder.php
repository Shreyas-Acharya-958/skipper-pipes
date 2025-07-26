<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ContactUsSection;

class ContactUsSectionSeeder extends Seeder
{
    public function run(): void
    {
        ContactUsSection::create([
            'section1' => '<h3>Get in Touch</h3><p>We\'d love to hear from you. Send us a message and we\'ll respond as soon as possible.</p>',
            'section2' => '<h3>Office Location</h3><p>123 Business Street<br>City, State 12345<br>Country</p>',
            'section3' => '<h3>Contact Information</h3><p>Phone: +1 (555) 123-4567<br>Email: info@example.com<br>Fax: +1 (555) 123-4568</p>',
            'section4' => '<h3>Business Hours</h3><p>Monday - Friday: 9:00 AM - 6:00 PM<br>Saturday: 10:00 AM - 4:00 PM<br>Sunday: Closed</p>',
        ]);
    }
}
