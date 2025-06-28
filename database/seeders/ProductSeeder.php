<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Get category IDs
        $plumbingId = ProductCategory::where('name', 'Plumbing & Sewage')->first()->id;
        $agricultureId = ProductCategory::where('name', 'Agriculture Pipes')->first()->id;
        $borewellId = ProductCategory::where('name', 'Borewell')->first()->id;
        $hdpeId = ProductCategory::where('name', 'HDPE Pipes')->first()->id;

        $products = [
            // Plumbing & Sewage Category
            [
                'product_category_id' => $plumbingId,
                'title' => 'UPVC Pipes',
                'slug' => 'upvc-pipes',
                'page_image' => 'products/upvc-pipes.jpg',
                'product_overview' => '<p>Skipper\'s UPVC pipes are manufactured using the latest technology and highest quality raw materials. These pipes are ideal for potable water supply and plumbing applications in residential and commercial buildings.</p>
                <p>Our UPVC pipes offer excellent resistance to chemicals, corrosion, and UV radiation, ensuring long-lasting performance and reliability.</p>',
                'product_overview_image' => 'products/upvc-overview.jpg',
                'features_benefits' => '<ul>
                    <li>High tensile strength and impact resistance</li>
                    <li>Lead-free and non-toxic</li>
                    <li>UV stabilized for longer life</li>
                    <li>Smooth internal surface for better flow</li>
                    <li>Easy installation and maintenance</li>
                    <li>Cost-effective solution</li>
                </ul>',
                'technical' => '<table class="table">
                    <tr><th>Size Range</th><td>15mm to 200mm</td></tr>
                    <tr><th>Pressure Rating</th><td>4kg/cm² to 10kg/cm²</td></tr>
                    <tr><th>Length</th><td>3m, 6m (standard)</td></tr>
                    <tr><th>Standards</th><td>IS 4985, ASTM D 1785</td></tr>
                </table>',
                'application' => '<ul>
                    <li>Potable water distribution systems</li>
                    <li>Hot and cold water plumbing</li>
                    <li>Industrial process lines</li>
                    <li>Swimming pools and water features</li>
                    <li>Irrigation systems</li>
                </ul>',
                'faq' => '<div class="faq-item">
                    <h4>What is the life expectancy of UPVC pipes?</h4>
                    <p>Under normal conditions, UPVC pipes can last 50+ years.</p>
                </div>
                <div class="faq-item">
                    <h4>Are UPVC pipes safe for drinking water?</h4>
                    <p>Yes, our UPVC pipes are completely safe for drinking water as they are lead-free and non-toxic.</p>
                </div>',
                'status' => true
            ],
            [
                'product_category_id' => $plumbingId,
                'title' => 'CPVC Pipes',
                'slug' => 'cpvc-pipes',
                'page_image' => 'products/cpvc-pipes.jpg',
                'product_overview' => '<p>Skipper\'s CPVC pipes are specifically designed for hot and cold water distribution systems. These pipes can withstand high temperatures up to 93°C, making them perfect for both residential and industrial applications.</p>',
                'product_overview_image' => 'products/cpvc-overview.jpg',
                'features_benefits' => '<ul>
                    <li>High temperature resistance</li>
                    <li>Superior chemical resistance</li>
                    <li>Fire-resistant properties</li>
                    <li>Low thermal conductivity</li>
                    <li>Corrosion-resistant</li>
                </ul>',
                'technical' => '<table class="table">
                    <tr><th>Size Range</th><td>15mm to 100mm</td></tr>
                    <tr><th>Temperature Range</th><td>0°C to 93°C</td></tr>
                    <tr><th>Pressure Rating</th><td>7kg/cm² to 28kg/cm²</td></tr>
                    <tr><th>Standards</th><td>IS 15778, ASTM D 2846</td></tr>
                </table>',
                'application' => '<ul>
                    <li>Hot and cold water distribution</li>
                    <li>Industrial process lines</li>
                    <li>Chemical processing</li>
                    <li>Food processing plants</li>
                    <li>Healthcare facilities</li>
                </ul>',
                'faq' => '<div class="faq-item">
                    <h4>Why choose CPVC over traditional metal pipes?</h4>
                    <p>CPVC offers better corrosion resistance, lower heat loss, and longer service life compared to metal pipes.</p>
                </div>',
                'status' => true
            ],
            // Agriculture Category
            [
                'product_category_id' => $agricultureId,
                'title' => 'Agriculture Column Pipes',
                'slug' => 'agriculture-column-pipes',
                'page_image' => 'products/agri-pipes.jpg',
                'product_overview' => '<p>Our agriculture column pipes are designed for efficient water transportation in agricultural applications. These pipes offer superior strength and durability for submersible pump applications.</p>',
                'product_overview_image' => 'products/agri-overview.jpg',
                'features_benefits' => '<ul>
                    <li>High tensile strength</li>
                    <li>UV stabilized</li>
                    <li>Excellent flow characteristics</li>
                    <li>Leak-proof threaded connections</li>
                    <li>Long service life</li>
                </ul>',
                'technical' => '<table class="table">
                    <tr><th>Diameter Range</th><td>40mm to 150mm</td></tr>
                    <tr><th>Length</th><td>3m (standard)</td></tr>
                    <tr><th>Pressure Rating</th><td>6kg/cm² to 10kg/cm²</td></tr>
                </table>',
                'application' => '<ul>
                    <li>Submersible pump installations</li>
                    <li>Irrigation systems</li>
                    <li>Water supply in agriculture</li>
                    <li>Borewell applications</li>
                </ul>',
                'faq' => '<div class="faq-item">
                    <h4>What is the maximum depth these pipes can be installed?</h4>
                    <p>Our agriculture column pipes can be safely installed up to 1000 feet depth, depending on the pressure rating.</p>
                </div>',
                'status' => true
            ],
            // Borewell Category
            [
                'product_category_id' => $borewellId,
                'title' => 'Ribbed Strainer Pipes',
                'slug' => 'ribbed-strainer-pipes',
                'page_image' => 'products/strainer-pipes.jpg',
                'product_overview' => '<p>Skipper\'s Ribbed Strainer Pipes are specially designed for borewell applications, featuring precision-engineered slots for optimal water intake while preventing sand infiltration.</p>',
                'product_overview_image' => 'products/strainer-overview.jpg',
                'features_benefits' => '<ul>
                    <li>High slot efficiency</li>
                    <li>Superior collapse resistance</li>
                    <li>Excellent sand control</li>
                    <li>Corrosion resistant</li>
                    <li>Long service life</li>
                </ul>',
                'technical' => '<table class="table">
                    <tr><th>Available Sizes</th><td>100mm to 200mm</td></tr>
                    <tr><th>Slot Sizes</th><td>0.75mm to 2mm</td></tr>
                    <tr><th>Material</th><td>High-grade PVC</td></tr>
                </table>',
                'application' => '<ul>
                    <li>Water well construction</li>
                    <li>Borewell filtration</li>
                    <li>Groundwater collection</li>
                    <li>Dewatering systems</li>
                </ul>',
                'faq' => '<div class="faq-item">
                    <h4>How do ribbed strainer pipes prevent sand infiltration?</h4>
                    <p>The precisely engineered slots and ribs create a natural filter that allows water flow while blocking sand particles.</p>
                </div>',
                'status' => true
            ],
            // HDPE Category
            [
                'product_category_id' => $hdpeId,
                'title' => 'HDPE Water Supply Pipes',
                'slug' => 'hdpe-water-supply-pipes',
                'page_image' => 'products/hdpe-pipes.jpg',
                'product_overview' => '<p>Our HDPE pipes are manufactured using the latest technology and premium grade PE100 material. These pipes offer exceptional durability and flexibility for water supply and industrial applications.</p>',
                'product_overview_image' => 'products/hdpe-overview.jpg',
                'features_benefits' => '<ul>
                    <li>High impact strength</li>
                    <li>Flexible and lightweight</li>
                    <li>Chemical resistant</li>
                    <li>UV stabilized</li>
                    <li>Long service life</li>
                </ul>',
                'technical' => '<table class="table">
                    <tr><th>Size Range</th><td>20mm to 630mm</td></tr>
                    <tr><th>Pressure Rating</th><td>PN 2.5 to PN 16</td></tr>
                    <tr><th>Material Grade</th><td>PE100</td></tr>
                </table>',
                'application' => '<ul>
                    <li>Water supply networks</li>
                    <li>Industrial fluid transport</li>
                    <li>Mining applications</li>
                    <li>Gas distribution</li>
                </ul>',
                'faq' => '<div class="faq-item">
                    <h4>What makes HDPE pipes better than traditional pipes?</h4>
                    <p>HDPE pipes offer better flexibility, chemical resistance, and longer service life compared to traditional materials.</p>
                </div>',
                'status' => true
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}