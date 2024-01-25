<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CmsPage;

class CmsPageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $cmsPagesRecords = [
            ['id' => 1, 'title' => 'About Us', 'description' => 'Learn more about our company.', 'url' => 'about-us', 'meta_title' => 'About Us - Company Name', 'meta_description' => 'About us page description.', 'meta_keywords' => 'company, about us', 'status' => 1],
            ['id' => 2, 'title' => 'Terms and Conditions', 'description' => 'Read our terms and conditions.', 'url' => 'terms-and-conditions', 'meta_title' => 'Terms and Conditions - Company Name', 'meta_description' => 'Terms and conditions page description.', 'meta_keywords' => 'terms, conditions', 'status' => 1],
            ['id' => 3, 'title' => 'Privacy Policy', 'description' => 'Our privacy policy to protect your information.', 'url' => 'privacy-policy', 'meta_title' => 'Privacy Policy - Company Name', 'meta_description' => 'Privacy policy page description.', 'meta_keywords' => 'privacy, policy', 'status' => 1],
            ['id' => 4, 'title' => 'Contact Us', 'description' => 'Get in touch with us.', 'url' => 'contact-us', 'meta_title' => 'Contact Us - Company Name', 'meta_description' => 'Contact us page description.', 'meta_keywords' => 'contact, us', 'status' => 1],
            ['id' => 5, 'title' => 'FAQ', 'description' => 'Frequently asked questions.', 'url' => 'faq', 'meta_title' => 'FAQ - Company Name', 'meta_description' => 'Frequently asked questions page description.', 'meta_keywords' => 'faq', 'status' => 1],
            ['id' => 6, 'title' => 'Services', 'description' => 'Explore our services.', 'url' => 'services', 'meta_title' => 'Services - Company Name', 'meta_description' => 'Services page description.', 'meta_keywords' => 'services', 'status' => 1],
            ['id' => 7, 'title' => 'Testimonials', 'description' => 'What our customers say about us.', 'url' => 'testimonials', 'meta_title' => 'Testimonials - Company Name', 'meta_description' => 'Testimonials page description.', 'meta_keywords' => 'testimonials', 'status' => 1],
            ['id' => 8, 'title' => 'Blog', 'description' => 'Read our latest blog posts.', 'url' => 'blog', 'meta_title' => 'Blog - Company Name', 'meta_description' => 'Blog page description.', 'meta_keywords' => 'blog', 'status' => 1],
            ['id' => 9, 'title' => ' Careers', 'description' => 'Join our team. Explore career opportunities.', 'url' => 'careers', 'meta_title' => 'Careers - Company Name', 'meta_description' => 'Careers page description.', 'meta_keywords' => 'careers', 'status' => 1],
        ];
        CmsPage::insert($cmsPagesRecords);
    }
}
