# Eco-Loop - Deployment Guide for Vercel

Panduan lengkap untuk deploy aplikasi Eco-Loop ke Vercel via GitHub.

## 📋 Prerequisites

1. **Akun Vercel** - Daftar di [vercel.com](https://vercel.com)
2. **GitHub Repository** - Project sudah di-push ke GitHub
3. **Node.js 18+** - Untuk build local (opsional)
4. **Database PostgreSQL** - Vercel menyediakan PostgreSQL gratis

## 🚀 Langkah Deploy ke Vercel

### Metode 1: Via Vercel Dashboard

1. **Buka** [vercel.com](https://vercel.com) dan login

2. **Klik** "Add New..." → "Project"

3. **Import** repository GitHub Anda:
   - Cari `eco-loop` atau nama repository Anda
   - Klik "Import"

4. **Konfigurasi Project**:
   - **Framework Preset**: `Laravel` (akan auto-detect)
   - **Root Directory**: `./` (default)
   - **Build Command**: `npm run build`
   - **Output Directory**: `dist`

5. **Environment Variables** - Klik "Environment Variables" dan tambahkan:

   ```env
   APP_NAME=Eco-Loop
   APP_ENV=production
   APP_KEY=  # Generate dengan php artisan key:generate
   APP_DEBUG=false
   APP_URL=https://your-project.vercel.app

   # Database (Vercel PostgreSQL)
   DB_CONNECTION=pgsql
   DB_HOST=your-postgres-host
   DB_PORT=5432
   DB_DATABASE=eco_loop
   DB_USERNAME=your_username
   DB_PASSWORD=your_password

   # Redis (Vercel KV - opsional)
   CACHE_STORE=redis
   QUEUE_CONNECTION=redis
   REDIS_HOST=your-redis-host
   REDIS_PASSWORD=your-redis-password

   # Mail (Mailgun)
   MAIL_MAILER=mailgun
   MAILGUN_DOMAIN=your-domain
   MAILGUN_SECRET=your-secret
   ```

6. **Klik** "Deploy"

7. Tunggu build selesai (~2-5 menit)

8. Jika berhasil, Anda akan mendapat URL seperti: `https://eco-loop-xxx.vercel.app`

### Metode 2: Via Vercel CLI

```bash
# 1. Install Vercel CLI
npm i -g vercel

# 2. Login ke Vercel
vercel login

# 3. Deploy (preview)
vercel

# 4. Deploy ke Production
vercel --prod
```

## 🔧 Setup Setelah Deploy

### 1. Generate APP_KEY

Jalankan perintah ini di terminal lokal Anda:

```bash
# Generate key
php artisan key:generate --show

# Atau buat baru
php artisan key:generate
```

Copy hasil ke environment variable `APP_KEY` di Vercel Dashboard.

### 2. Setup Database

1. Buat PostgreSQL database di Vercel:
   - Buka project → Storage → Create Database
   - Pilih PostgreSQL
   - Copy connection string

2. Update environment variables dengan credentials baru

3. Jalankan migrations:
   ```bash
   # Menggunakan Vercel CLI
   vercel env pull .env.vercel
   php artisan migrate --force
   ```

### 3. Setup Storage (File Uploads)

Untuk upload gambar/produk:

```env
FILESYSTEM_DISK=public

# S3 Configuration (opsional)
AWS_ACCESS_KEY_ID=xxx
AWS_SECRET_ACCESS_KEY=xxx
AWS_DEFAULT_REGION=ap-southeast-1
AWS_BUCKET=eco-loop-uploads
```

### 4. Setup Mail (Mailgun)

1. Daftar di [mailgun.com](https://www.mailgun.com)
2. Verify domain Anda
3. Copy API key ke environment variables

## 📁 File Struktur Deployment

```
eco-loop/
├── vercel.json          # Konfigurasi Vercel
├── .vercelignore        # File yang tidak di-deploy
├── api/
│   └── index.php        # Entry point untuk Vercel
├── dist/                # Output build (auto-generated)
├── resources/
│   ├── css/
│   ├── js/
│   └── views/
├── routes/
├── app/
├── config/
└── ...
```

## ⚠️ Troubleshooting

### Build Gagal

**Error**: `npm run build` fails
**Solusi**:
```bash
# Clear cache
npm cache clean --force

# Reinstall dependencies
rm -rf node_modules
npm install
npm run build
```

### Error 500 Setelah Deploy

**Penyebab**: APP_KEY tidak cocok atau database error

**Solusi**:
1. Cek APP_KEY di environment variables
2. Verify database credentials
3. Cek logs di Vercel Dashboard → Functions

### Error 404 pada Asset

**Penyebab**: Build output directory salah

**Solusi**: Pastikan `vercel.json` memiliki:
```json
{
  "outputDirectory": "dist"
}
```

### Halaman Putih

**Penyebab**: APP_DEBUG=false dan ada error

**Solusi**: Set `APP_DEBUG=true` sementara untuk melihat error

## 🔄 Auto Deploy

Dengan GitHub integration:

1. Push code ke branch `main`
2. Vercel auto-detect perubahan
3. Otomatis build dan deploy

Custom domain? Buka Vercel Dashboard → Settings → Domains

## 📞 Need Help?

- [Vercel Docs](https://vercel.com/docs)
- [Laravel Vercel Integration](https://vercel.com/frameworks/laravel)
- [GitHub Issues](https://github.com/vercel/vercel/discussions)

---

**© 2026 Eco-Loop - Tim Hanchou Sanchou**
