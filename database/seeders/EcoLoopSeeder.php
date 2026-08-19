<?php

namespace Database\Seeders;

use App\Models\Badge;
use App\Models\Category;
use App\Models\Product;
use App\Models\Reward;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EcoLoopSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin Eco-Loop',
            'email' => 'admin@eco-loop.id',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'region' => 'Jakarta',
            'total_carbon_saved' => 0,
            'total_vouchers' => 0,
            'total_orders' => 0,
        ]);

        // Create sample sellers
        $sellers = [
            ['name' => 'Pak Hadi - Peternak', 'email' => 'hadi@example.com', 'region' => 'Bandung', 'phone' => '081234567890'],
            ['name' => 'Ibu Sri - Pengrajin', 'email' => 'sri@example.com', 'region' => 'Surabaya', 'phone' => '081234567891'],
            ['name' => 'Pak Agus - Petani', 'email' => 'agus@example.com', 'region' => 'Yogyakarta', 'phone' => '081234567892'],
            ['name' => 'Bu Dewi - Pengolah Sampah', 'email' => 'dewi@example.com', 'region' => 'Jakarta', 'phone' => '081234567893'],
            ['name' => 'Mas Rudi - Kolektor', 'email' => 'rudi@example.com', 'region' => 'Semarang', 'phone' => '081234567894'],
        ];

        foreach ($sellers as $sellerData) {
            User::create([
                'name' => $sellerData['name'],
                'email' => $sellerData['email'],
                'password' => Hash::make('password'),
                'role' => 'seller',
                'region' => $sellerData['region'],
                'phone' => $sellerData['phone'],
                'total_carbon_saved' => rand(10, 100) + (rand(0, 100) / 100),
                'total_vouchers' => rand(50, 500),
                'total_orders' => rand(5, 30),
            ]);
        }

        // Create sample buyers
        $buyers = [
            ['name' => 'Andi Wijaya', 'email' => 'andi@example.com', 'region' => 'Bandung'],
            ['name' => 'Rina Kartika', 'email' => 'rina@example.com', 'region' => 'Surabaya'],
            ['name' => 'Budi Santoso', 'email' => 'budi@example.com', 'region' => 'Jakarta'],
            ['name' => 'Siti Aminah', 'email' => 'siti@example.com', 'region' => 'Yogyakarta'],
            ['name' => 'Doni Prasetyo', 'email' => 'doni@example.com', 'region' => 'Semarang'],
        ];

        foreach ($buyers as $buyerData) {
            User::create([
                'name' => $buyerData['name'],
                'email' => $buyerData['email'],
                'password' => Hash::make('password'),
                'role' => 'buyer',
                'region' => $buyerData['region'],
                'total_carbon_saved' => rand(5, 50) + (rand(0, 100) / 100),
                'total_vouchers' => rand(20, 200),
                'total_orders' => rand(1, 15),
            ]);
        }

        // Create categories - NEW STRUCTURE
        $categories = [
            // PRODUK - Olahan dari sampah/makanan
            [
                'name' => 'Produk Olahan',
                'slug' => 'produk-olahan',
                'description' => 'Produk hasil olahan dari sampah atau makanan: kulit sapi/kambing, kompos, pupuk organik',
                'icon' => 'fa-recycle',
                'carbon_value_per_kg' => 0.8,
                'type' => 'product', // untuk filtering
            ],
            // MAKANAN SISA - Untuk pakan hewan
            [
                'name' => 'Makanan Sisa',
                'slug' => 'makanan-sisa',
                'description' => 'Sisa makanan manusia yang masih bisa digunakan sebagai pakan hewan ternak',
                'icon' => 'fa-utensils',
                'carbon_value_per_kg' => 0.6,
                'type' => 'food_waste',
            ],
            // RUMPUT/PAGAN - Makanan untuk ternak
            [
                'name' => 'Rumput & Pakan Ternak',
                'slug' => 'rumput-pakan',
                'description' => 'Rumput segar, jerami, dan pakan ternak lainnya untuk sapi, kambing, domba',
                'icon' => 'fa-seedling',
                'carbon_value_per_kg' => 0.45,
                'type' => 'forage',
            ],
            // SAMPAH DAUR ULANG
            [
                'name' => 'Sampah Daur Ulang',
                'slug' => 'sampah-daur-ulang',
                'description' => 'Sampah plastik, karet, kaleng, dan material daur ulang lainnya',
                'icon' => 'fa-trash-alt',
                'carbon_value_per_kg' => 0.35,
                'type' => 'recyclable',
            ],
        ];

        foreach ($categories as $categoryData) {
            Category::create([
                'name' => $categoryData['name'],
                'slug' => $categoryData['slug'],
                'description' => $categoryData['description'],
                'icon' => $categoryData['icon'],
                'carbon_value_per_kg' => $categoryData['carbon_value_per_kg'],
                'is_active' => true,
            ]);
        }

        // Create sample products
        $allSellers = User::where('role', 'seller')->get();
        $categoryMap = Category::pluck('id', 'slug')->toArray();

        $products = [
            // Produk Olahan
            ['name' => 'Kulit Sapi Olahan - Premium', 'category' => 'produk-olahan', 'price' => 85000, 'weight' => 2, 'condition' => 'new', 'description' => 'Kulit sapi premium untuk kerajinan tangan, tebal dan kuat'],
            ['name' => 'Kulit Kambing Olahan', 'category' => 'produk-olahan', 'price' => 55000, 'weight' => 1, 'condition' => 'new', 'description' => 'Kulit kambing untuk tas, dompet, dan aksesoris'],
            ['name' => 'Kompos Organik Premium 5kg', 'category' => 'produk-olahan', 'price' => 35000, 'weight' => 5, 'condition' => 'new', 'description' => 'Kompos dari sisa makanan, cocok untuk tanaman organik'],
            ['name' => 'Pupuk Cair Organik 2L', 'category' => 'produk-olahan', 'price' => 28000, 'weight' => 2, 'condition' => 'new', 'description' => 'Pupuk cair dari fermentasi sisa dapur'],
            ['name' => 'Briket Arang Sekam', 'category' => 'produk-olahan', 'price' => 15000, 'weight' => 3, 'condition' => 'new', 'description' => 'Briket dari sekam padi, ramah lingkungan untuk masak'],

            // Makanan Sisa
            ['name' => 'Nasi Sisa Katering 10kg', 'category' => 'makanan-sisa', 'price' => 10000, 'weight' => 10, 'condition' => 'good', 'description' => 'Nasi sisa dari acara, masih layak untuk pakan babi/unggas'],
            ['name' => 'Sayur Sisa Pasar 5kg', 'category' => 'makanan-sisa', 'price' => 8000, 'weight' => 5, 'condition' => 'good', 'description' => 'Sayuran sisa pasar, cocok untuk pakan sapi'],
            ['name' => 'Kulit Pisang 3kg', 'category' => 'makanan-sisa', 'price' => 5000, 'weight' => 3, 'condition' => 'good', 'description' => 'Kulit pisang untuk pakan ikan lele atau kompos'],
            ['name' => 'Amplas Tahu 10kg', 'category' => 'makanan-sisa', 'price' => 12000, 'weight' => 10, 'condition' => 'good', 'description' => 'Amplas tahu tinggi protein untuk pakan ikan'],

            // Rumput & Pakan Ternak
            ['name' => 'Rumput Gajah Mini Segar 10kg', 'category' => 'rumput-pakan', 'price' => 15000, 'weight' => 10, 'condition' => 'new', 'description' => 'Rumput gajah mini segar, cocok untuk kambing dan domba'],
            ['name' => 'Rumput Odot Premium 5kg', 'category' => 'rumput-pakan', 'price' => 12000, 'weight' => 5, 'condition' => 'new', 'description' => 'Rumput odot untuk sapi perah, tinggi nutrisi'],
            ['name' => 'Rumput Setaria Segar 8kg', 'category' => 'rumput-pakan', 'price' => 14000, 'weight' => 8, 'condition' => 'new', 'description' => 'Rumput setaria untuk sapi potong'],
            ['name' => 'Jerami Padi Kering 15kg', 'category' => 'rumput-pakan', 'price' => 18000, 'weight' => 15, 'condition' => 'new', 'description' => 'Jerami padi kering untuk pakan musim kemarau'],
            ['name' => 'Daun Gamal Kering 5kg', 'category' => 'rumput-pakan', 'price' => 10000, 'weight' => 5, 'condition' => 'new', 'description' => 'Daun gamal sebagai pakan tambahan ternak'],

            // Sampah Daur Ulang
            ['name' => 'Botol Plastik HDPE 5kg', 'category' => 'sampah-daur-ulang', 'price' => 8000, 'weight' => 5, 'condition' => 'good', 'description' => 'Botol plastik HDPE untuk didaur ulang'],
            ['name' => 'Kaleng Aluminium 3kg', 'category' => 'sampah-daur-ulang', 'price' => 15000, 'weight' => 3, 'condition' => 'good', 'description' => 'Kaleng minuman, nilai jual tinggi'],
            ['name' => 'Karet Bekas 4kg', 'category' => 'sampah-daur-ulang', 'price' => 6000, 'weight' => 4, 'condition' => 'good', 'description' => 'Karet ban bekas untuk industri ban vulkanisir'],
            ['name' => 'Kardus Bekas 5kg', 'category' => 'sampah-daur-ulang', 'price' => 4000, 'weight' => 5, 'condition' => 'good', 'description' => 'Kardus dus untuk daur ulang kertas'],
            ['name' => 'Besaran Elektronik 2kg', 'category' => 'sampah-daur-ulang', 'price' => 25000, 'weight' => 2, 'condition' => 'good', 'description' => 'Sisa elektronik untuk recovery emas/perak'],
        ];

        foreach ($products as $productData) {
            $seller = $allSellers->random();
            $category = Category::where('slug', $productData['category'])->first();

            Product::create([
                'user_id' => $seller->id,
                'category_id' => $categoryMap[$productData['category']],
                'name' => $productData['name'],
                'description' => $productData['description'],
                'price' => $productData['price'],
                'weight' => $productData['weight'],
                'stock' => rand(1, 10),
                'condition' => $productData['condition'],
                'status' => 'available',
                'carbon_saved' => $productData['weight'] * $category->carbon_value_per_kg,
                'is_active' => true,
            ]);
        }

        // Create rewards
        $rewards = [
            [
                'name' => 'Diskon 10%',
                'description' => 'Diskon 10% untuk pembelian berikutnya',
                'type' => 'discount',
                'value' => '10%',
                'points_required' => 50,
                'stock' => -1,
            ],
            [
                'name' => 'Tas Ramah Lingkungan',
                'description' => 'Tas belanja kain yang bisa digunakan berulang kali',
                'type' => 'product',
                'value' => 'Eco Bag',
                'points_required' => 100,
                'stock' => 50,
            ],
            [
                'name' => 'Bibit Pohon Buah',
                'description' => 'Bibit pohon buah lokal Indonesia (mangga, jambu, dll)',
                'type' => 'product',
                'value' => 'Tree Seedling',
                'points_required' => 150,
                'stock' => 100,
            ],
            [
                'name' => 'Donasi Penghijauan',
                'description' => 'Donasi untuk penanaman 1 pohon di hutan Indonesia',
                'type' => 'donation',
                'value' => '1 Tree Planted',
                'points_required' => 200,
                'stock' => -1,
            ],
        ];

        foreach ($rewards as $rewardData) {
            Reward::create(array_merge($rewardData, ['is_active' => true]));
        }

        // Create badges
        $badges = [
            [
                'name' => 'Pemula Hijau',
                'slug' => 'pemula-hijau',
                'description' => 'Baru memulai perjalanan ramah lingkungan',
                'icon' => 'fa-seedling',
                'color' => '#22c55e',
                'requirement' => 1,
                'requirement_type' => 'carbon_total',
            ],
            [
                'name' => 'Pahlawan Lingkungan',
                'slug' => 'pahlawan-lingkungan',
                'description' => 'Telah menghemat lebih dari 10 kg CO2',
                'icon' => 'fa-hands-helping',
                'color' => '#10b981',
                'requirement' => 10,
                'requirement_type' => 'carbon_total',
            ],
            [
                'name' => 'Juara Hijau',
                'slug' => 'juara-hijau',
                'description' => 'Telah menghemat lebih dari 50 kg CO2',
                'icon' => 'fa-trophy',
                'color' => '#f59e0b',
                'requirement' => 50,
                'requirement_type' => 'carbon_total',
            ],
            [
                'name' => 'Duta Karbon',
                'slug' => 'duta-karbon',
                'description' => 'Top 10 penghematan karbon',
                'icon' => 'fa-medal',
                'color' => '#ef4444',
                'requirement' => 100,
                'requirement_type' => 'carbon_total',
            ],
        ];

        foreach ($badges as $badgeData) {
            Badge::create(array_merge($badgeData, ['is_active' => true]));
        }
    }
}
