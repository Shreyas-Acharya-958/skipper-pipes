<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CompanyPageSeeder extends Seeder
{
    public function run()
    {
        $pages = [
            [
                'title' => 'Overview',
                'short_description' => 'Skipper Pipes is one of India\'s leading manufacturers of high-quality piping solutions, committed to delivering innovative and sustainable products.',
                'long_description' => '
                    <h2>About Skipper Pipes</h2>
                    <p>Skipper Pipes has established itself as a pioneer in the piping industry, with a legacy of excellence spanning several decades. Our commitment to quality, innovation, and customer satisfaction has made us one of India\'s most trusted names in piping solutions.</p>

                    <h3>Our Vision</h3>
                    <p>To be the most trusted and innovative piping solutions provider, contributing to India\'s infrastructure development while maintaining the highest standards of quality and sustainability.</p>

                    <h3>Our Mission</h3>
                    <p>- To deliver superior quality piping solutions that exceed customer expectations<br>
                    - To maintain the highest standards of manufacturing excellence<br>
                    - To innovate continuously and adopt the latest technologies<br>
                    - To contribute to sustainable development</p>

                    <h3>Infrastructure</h3>
                    <p>Our state-of-the-art manufacturing facilities are equipped with the latest technology and machinery, ensuring the highest quality standards in every product we produce.</p>
                ',
            ],
            [
                'title' => 'Leadership',
                'short_description' => 'Meet the visionary leaders who drive Skipper Pipes towards excellence and innovation in the piping industry.',
                'long_description' => '
                    <h2>Our Leadership Team</h2>
                    <p>The success of Skipper Pipes is driven by our experienced and visionary leadership team, who bring decades of industry expertise and a commitment to excellence.</p>

                    <h3>Board of Directors</h3>
                    <ul>
                        <li>Mr. Sajan Kumar Bansal - Managing Director</li>
                        <li>Mr. Siddharth Bansal - Director</li>
                    </ul>

                    <h3>Management Team</h3>
                    <p>Our management team comprises industry veterans with extensive experience in manufacturing, technology, sales, and customer service.</p>
                ',
            ],
            [
                'title' => 'Manufacturing',
                'short_description' => 'Discover our state-of-the-art manufacturing facilities that produce high-quality piping solutions using the latest technology.',
                'long_description' => '
                    <h2>Manufacturing Excellence</h2>
                    <p>At Skipper Pipes, we maintain world-class manufacturing facilities equipped with the latest technology and automation systems to ensure consistent quality and efficiency.</p>

                    <h3>Our Facilities</h3>
                    <p>Our manufacturing units are strategically located across India, featuring:</p>
                    <ul>
                        <li>Advanced automation systems</li>
                        <li>Quality control laboratories</li>
                        <li>Modern machinery and equipment</li>
                        <li>Skilled workforce</li>
                    </ul>

                    <h3>Quality Standards</h3>
                    <p>We adhere to the highest quality standards and hold various national and international certifications.</p>
                ',
            ],
            [
                'title' => 'CSR',
                'short_description' => 'Learn about our commitment to corporate social responsibility and sustainable development initiatives.',
                'long_description' => '
                    <h2>Corporate Social Responsibility</h2>
                    <p>At Skipper Pipes, we believe in giving back to society and contributing to sustainable development.</p>

                    <h3>Our Initiatives</h3>
                    <ul>
                        <li>Environmental Conservation</li>
                        <li>Education Support Programs</li>
                        <li>Community Development</li>
                        <li>Healthcare Initiatives</li>
                    </ul>

                    <h3>Sustainability Commitment</h3>
                    <p>We are committed to reducing our environmental footprint and promoting sustainable practices in all our operations.</p>
                ',
            ],
            [
                'title' => 'Certifications',
                'short_description' => 'View our quality certifications and standards that demonstrate our commitment to excellence.',
                'long_description' => '
                    <h2>Our Certifications</h2>
                    <p>Skipper Pipes holds various national and international certifications that validate our commitment to quality and excellence.</p>

                    <h3>Quality Certifications</h3>
                    <ul>
                        <li>ISO 9001:2015 - Quality Management System</li>
                        <li>ISO 14001:2015 - Environmental Management System</li>
                        <li>IS 4985:2000 - Bureau of Indian Standards</li>
                        <li>ASTM Standards Compliance</li>
                    </ul>

                    <h3>Testing Facilities</h3>
                    <p>Our in-house testing laboratories ensure that all products meet the highest quality standards before reaching our customers.</p>
                ',
            ],
        ];

        foreach ($pages as $page) {
            DB::table('company_pages')->insert([
                'title' => $page['title'],
                'slug' => Str::slug($page['title']),
                'short_description' => $page['short_description'],
                'long_description' => $page['long_description'],
                'status' => true,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
