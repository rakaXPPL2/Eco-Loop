# 🌿 Eco-Loop - Marketplace Keberlanjutan

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-13-red?style=for-the-badge" alt="Laravel">
  <img src="https://img.shields.io/badge/PHP-8.3-blue?style=for-the-badge" alt="PHP">
  <img src="https://img.shields.io/badge/Tailwind-CSS-38b2ac?style=for-the-badge" alt="Tailwind">
  <img src="https://img.shields.io/badge/MySQL-8.x-4479A1?style=for-the-badge" alt="MySQL">
  <img src="https://img.shields.io/badge/license-MIT-green?style=for-the-badge" alt="License">
</p>

---

## 📖 Tentang Proyek

**Eco-Loop** adalah platform e-commerce berkelanjutan yang menghubungkan penjual dan pembeli barang-barang ramah lingkungan di Indonesia. Aplikasi ini mendorong ekonomi sirkular dengan memfasilitasi jual-beli:

- 🛍️ **Barang Daur Ulang** - Produk handmade dari bahan daur ulang
- 🌾 **Rumput & Pakan Ternak** - rumput pakan dan limbah pertanian
- 🍽️ **Makanan Sisa** - sisa makanan untuk kompos atau pakan ternak
- ♻️ **Sampah Daur Ulang** - plastik, kertas, dan logam daur ulang

### ⭐ Fitur Utama

| Fitur | Deskripsi |
|-------|-----------|
| **Sistem Karbon** | Setiap transaksi menghitung pengurangan jejak karbon |
| **Eco-Points (Otomatis)** | Poin reward dihitung otomatis berdasarkan berat/kuantitas produk saat transaksi selesai |
| **Voucher System** | Voucher karbon otomatis diberikan saat order completed (buyer & seller) |
| **Badge System** | Lencana otomatis untuk pencapaian karbon |
| **Eco-Shop** | Tukar poin voucher dengan hadiah menarik |
| **Leaderboard Real-Time** | Peringkat Top Penjual & Top Pembeli berdasarkan penghematan karbon |
| **Role-Based Access** | Admin, Seller, dan Buyer dengan hak akses berbeda |
| **Admin Monitoring Dashboard** | Dashboard landing admin dengan grafik & statistik mingguan |
| **Payment Gateway** | Simulasi pembayaran dengan konfirmasi admin |
| **Buyer-Seller Chat** | Sistem pesan langsung antara pembeli dan penjual |
| **Complaint System** | Sistem pengaduan untuk menyelesaikan masalah |
| **Admin Statistics** | Dashboard analytics untuk performa platform |
| **Seller Statistics** | Analytics penjualan untuk penjual |
| **Product Location** | Informasi kota lokasi produk |

---

## 🏗️ Arsitektur Sistem

### Entity Relationship Diagram (Simplified)

```
┌─────────────────────────────────────────────────────────────────────────┐
│                              ECO-LOOP                                   │
├─────────────────────────────────────────────────────────────────────────┤
│                                                                         │
│   ┌──────────┐      ┌──────────┐      ┌──────────┐                 │
│   │   USER   │      │  STORE   │      │ CATEGORY │                 │
│   │  (role)  │──────│  (seller)│      │          │                 │
│   └────┬─────┘      └──────────┘      └────┬─────┘                 │
│        │                                      │                        │
│        │1          ┌──────────┐           1│                        │
│        ├───────────│  PRODUCT  │────────────┤                        │
│        │            └────┬─────┘            │                        │
│        │                 │                    │                        │
│        │                 │1                   │                        │
│        │       ┌─────────┴─────────┐        │                        │
│        │       │                   │        │                        │
│        │       ▼                   ▼        │                        │
│   ┌────┴───┐           ┌────────┴────┐    │                        │
│   │  CART  │           │    ORDER    │◄───┘                        │
│   │ (buyer)│           │  (buyer)    │                              │
│   └─────────┘           └──────┬─────┘                              │
│                                 │                                     │
│                        ┌────────┴────────┐                           │
│                        │   ORDER_ITEM   │                           │
│                        └────────────────┘                           │
│                                                                         │
│   ┌──────────┐  ┌──────────┐  ┌──────────┐  ┌──────────┐         │
│   │  BADGE   │  │ VOUCHER  │  │  MESSAGE │  │ COMPLAINT │         │
│   │ (buyer)  │  │ (buyer)  │  │(buyer<>  │  │ (buyer)   │         │
│   └──────────┘  │ (seller) │  │ seller)  │  └──────────┘         │
│                 └──────────┘  └──────────┘                         │
│                                                                         │
└─────────────────────────────────────────────────────────────────────────┘
```

### Role-Based Access Control

| Role | Kemampuan | Fitur Utama |
|------|-----------|-------------|
| **Buyer** | Browse, Belanja, Chat | Keranjang, Checkout, Voucher, Karbon Tersimpan |
| **Seller** | Jual Produk, Kelola Toko | Statistik Penjualan, Produk, Analytics |
| **Admin** | Kelola Platform | Statistik Platform, Kelola Pengguna, Payment |

---

## 🛠️ Tech Stack

| Layer | Teknologi |
|-------|-----------|
| **Backend** | Laravel 13 (PHP 8.3) |
| **Frontend** | Blade Templates + React |
| **Database** | MySQL 8.x |
| **Cache/Session** | Database |
| **Build** | Vite + Tailwind CSS |
| **Testing** | PHPUnit |

---

## 🚀 Cara Memulai

### Prerequisites

- PHP 8.3+
- Composer 2.x
- Node.js 18+
- MySQL 8.x

### Installation

```bash
# 1. Clone repository
git clone https://github.com/rakaXPPL2/Eco-Loop.git
cd Eco-Loop

# 2. Install dependencies
composer install
npm install

# 3. Copy environment file
cp .env.example .env

# 4. Create MySQL database
mysql -u root -e "CREATE DATABASE IF NOT EXISTS eco_loop CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

# 5. Update .env (pastikan baris ini ada):
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=eco_loop
# DB_USERNAME=root
# DB_PASSWORD=

# 6. Generate application key
php artisan key:generate

# 7. Run migrations & seeders
php artisan migrate:fresh --seed

# 8. Build frontend assets
npm run build

# 9. Start development server
php artisan serve
```

### Development Mode (Recommended)

Jalankan server development dengan hot reload:

```bash
composer dev
```

Ini akan menjalankan:
- Laravel Server (port 8000)
- Vite Dev Server (hot reload)
- Queue Listener

### Testing

```bash
# Run all tests
php artisan test

# Run specific test
php artisan test --filter=TestName
```

---

## 📁 Struktur Direktori

```
Eco-Loop/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Auth/              # Laravel Breeze auth
│   │   │   └── EcoLoop/           # Business logic controllers
│   │   └── Requests/              # Form request validation
│   ├── Models/                    # Eloquent models (16 models)
│   ├── Observers/                 # OrderObserver (badge awarding)
│   └── Services/                  # PaymentService
├── database/
│   ├── migrations/               # Schema (25+ migrations)
│   ├── factories/                # Test factories
│   └── seeders/                  # Sample data
├── resources/
│   ├── views/
│   │   ├── eco-loop/           # Main views (60+ blade files)
│   │   │   ├── layouts/       # Layouts & partials
│   │   │   └── pages/         # Route pages
│   │   └── components/         # Blade components
│   └── js/
│       └── components/          # React components
├── routes/
│   ├── web.php                 # Main routes (88 routes)
│   └── auth.php                # Auth routes
├── tests/                      # PHPUnit tests (25 tests)
└── README.md
```

---

## 📊 Database Schema

### Tables (25+ tables)

| Table | Deskripsi |
|-------|-----------|
| `users` | Multi-role (admin/seller/buyer) dengan carbon tracking & voucher balance |
| `products` | Produk dengan category, stock, carbon value, dan lokasi kota |
| `categories` | Kategori produk dengan icon & carbon value per kg |
| `orders` | Transaksi dengan payment tracking |
| `order_items` | Item pesanan dengan seller_id |
| `carts` | Keranjang belanja per user |
| `cart_items` | Item di keranjang |
| `stores` | Toko penjual |
| `vouchers` | Voucher reward (buyer & seller) dengan points & expiry |
| `badges` | Lencana pencapaian |
| `user_badges` | Pivot user-badge |
| `rewards` | Reward items untuk eco-shop |
| `redemptions` | Riwayat redeem reward |
| `messages` | Chat buyer-seller |
| `complaints` | Pengaduan pengguna |
| `regions` | Region/wilayah |
| `notifications` | Sistem notifikasi real-time |
| `sessions` | User sessions |
| `cache` | Cache table |
| `jobs` | Queue jobs |

---

## 🎯 Endpoint API

### Public Routes
| Method | URI | Deskripsi |
|--------|-----|-----------|
| GET | `/` | Landing page |
| GET | `/products` | Katalog produk |
| GET | `/products/{id}` | Detail produk |
| GET | `/eco-shop` | Redeem rewards |
| GET | `/leaderboard` | Peringkat karbon |
| GET | `/stores/{id}` | Detail toko |

### Buyer Routes
| Method | URI | Deskripsi |
|--------|-----|-----------|
| GET | `/dashboard` | Dashboard buyer |
| GET | `/cart` | Keranjang belanja |
| POST | `/cart/{product}` | Tambah ke keranjang |
| PATCH | `/cart/{item}` | Update quantity |
| DELETE | `/cart/{item}` | Hapus item |
| GET | `/checkout` | Halaman checkout |
| POST | `/checkout` | Proses checkout |
| GET | `/checkout/payment/{order}` | Pembayaran |
| GET | `/checkout/success/{order}` | Sukses checkout |
| GET | `/orders` | Riwayat pesanan |
| GET | `/orders/{id}` | Detail pesanan |
| GET | `/dashboard/vouchers` | Daftar voucher |
| GET | `/dashboard/notifications` | Notifikasi |
| POST | `/complaints` | Buat pengaduan |
| GET | `/messages` | Daftar chat |
| GET | `/messages/{user}` | Detail chat |
| POST | `/products/{product}/chat` | Kirim chat ke penjual |

### Seller Routes
| Method | URI | Deskripsi |
|--------|-----|-----------|
| GET | `/dashboard` | Dashboard seller |
| GET | `/dashboard/statistics` | Statistik penjualan |
| GET | `/dashboard/products` | Daftar produk saya |
| GET | `/products/create` | Tambah produk baru |
| POST | `/products` | Simpan produk |
| GET | `/products/{id}/edit` | Edit produk |
| PATCH | `/products/{id}` | Update produk |
| DELETE | `/products/{id}` | Hapus produk |
| GET | `/dashboard/orders` | Pesanan masuk |
| GET | `/store/edit` | Pengaturan toko |

### Admin Routes
| Method | URI | Deskripsi |
|--------|-----|-----------|
| GET | `/admin/monitoring` | Dashboard monitoring utama dengan statistik mingguan |
| GET | `/admin/dashboard` | Dashboard admin |
| GET | `/admin/statistics` | Statistik platform |
| GET | `/admin/users` | Kelola pengguna |
| GET | `/admin/products` | Kelola produk |
| POST | `/admin/products/{id}/approve` | Approve produk |
| POST | `/admin/products/{id}/reject` | Reject produk |
| GET | `/admin/orders` | Kelola pesanan |
| GET | `/admin/payments` | Kelola pembayaran |
| POST | `/admin/payments/{id}/confirm` | Konfirmasi payment |
| POST | `/admin/payments/{id}/reject` | Tolak payment |
| GET | `/admin/stores` | Kelola toko |
| POST | `/admin/stores/{id}/verify` | Verifikasi toko |
| GET | `/admin/regions` | Kelola region |
| POST | `/admin/regions` | Tambah region |
| GET | `/admin/categories` | Kelola kategori |
| GET | `/admin/badges` | Kelola lencana |
| GET | `/admin/rewards` | Kelola reward |
| GET | `/admin/complaints` | Kelola pengaduan |
| PATCH | `/admin/complaints/{id}` | Update pengaduan |
| GET | `/admin/messages` | Kelola pesan |

---

## 🎯 Sistem Poin & Voucher

Eco-Loop memiliki sistem reward otomatis yang bekerja saat transaksi selesai:

### Kalkulasi Poin
- **1 kg CO2 dihemat** = **10 poin voucher**
- Poin dihitung dari `carbon_saved` produk × 10

### Alur Voucher Otomatis
```
Order Completed (status = 'completed')
    │
    ├── Buyer ──► Voucher (+carbon_saved × 10 poin)
    │              │
    │              └── Notification: "Voucher Karbon Diraih!"
    │
    └── Seller(s) ──► Voucher (+seller_carbon × 10 poin)
                       │
                       └── Notification: "Voucher Penjualan!"
```

### Leaderboard Real Data
Leaderboard menampilkan data real dari database dengan 2 tab:
- **Top Penjual**: Diurutkan berdasarkan total karbon yang dihemat
- **Top Pembeli**: Diurutkan berdasarkan transaksi & karbon dihemat

---

## 🔐 Keamanan

Fitur keamanan yang implemented:

- ✅ CSRF Protection
- ✅ Password Hashing (bcrypt)
- ✅ Authorization Gates & Policies
- ✅ Form Request Validation
- ✅ Mass Assignment Protection
- ✅ Rate Limiting (messaging)
- ✅ Email Verification
- ✅ Session Management

---

## 🎨 UI/UX Features

| Feature | Deskripsi |
|---------|-----------|
| 🌈 Eco-themed | Color palette (emerald, teal, lime) |
| 📱 Responsive | Mobile-first design |
| ✨ Animations | Smooth transitions & hover effects |
| 🔔 Toast Notifications | Real-time feedback |
| ⬆️ Back-to-Top | Scroll navigation |
| 🎴 Custom Scrollbar | Eco-themed scrollbar |
| 🌙 Dark Mode | Admin panel dark theme |
| 📊 Charts | Sales & carbon visualization |
| 🎴 Glassmorphism | Modern glass effects |

---

## 🧪 Testing

```bash
# Run all tests
php artisan test

# Run with coverage
php artisan test --coverage

# Run specific suite
php artisan test --testsuite=Feature
php artisan test --testsuite=Unit
```

**Test Coverage:**
- Authentication (login, register, password reset)
- Role-based access control
- Cart operations
- Checkout flow
- Product management
- Admin functions

---

## 📝 License

Proyek ini adalah open-source software yang dilisensikan di bawah [MIT license](https://opensource.org/licenses/MIT).

---

## 👥 Tim Pengembang

**Tim Hanchou Sanchou** - Innoventure Chapter II 2026

---

<p align="center">
  <sub>Built with ❤️ for a sustainable future</sub>
</p>
