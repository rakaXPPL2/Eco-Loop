# Eco-Loop - Deployment Checklist

## ✅ Files Created for Vercel Deployment

### Configuration Files
- [x] `vercel.json` - Vercel build configuration
- [x] `vercel.php` - Vercel PHP runtime configuration
- [x] `.vercelignore` - Files to exclude from deployment
- [x] `.env.production` - Production environment template
- [x] `.gitignore` - Updated to exclude build artifacts

### Entry Points
- [x] `api/index.php` - Vercel serverless function entry point
- [x] `public/index.php` - Standard Laravel entry (existing)

### Documentation
- [x] `DEPLOY_VERCEL.md` - Complete deployment guide

## 🚀 Deployment Steps

### Step 1: Push to GitHub
```bash
git add .
git commit -m "Add Vercel deployment configuration"
git push origin main
```

### Step 2: Connect to Vercel
1. Buka https://vercel.com
2. Import repository GitHub
3. Configure environment variables

### Step 3: Required Environment Variables
```env
APP_NAME=Eco-Loop
APP_ENV=production
APP_KEY=base64:xxxxx  # Generate dengan php artisan key:generate
APP_DEBUG=false
APP_URL=https://your-domain.vercel.app

# Database (PostgreSQL)
DB_CONNECTION=pgsql
DB_HOST=your-postgres-host
DB_PORT=5432
DB_DATABASE=eco_loop
DB_USERNAME=your_username
DB_PASSWORD=your_password

# Cache & Queue (Redis)
CACHE_STORE=redis
QUEUE_CONNECTION=redis
REDIS_HOST=your-redis-host
REDIS_PASSWORD=your-redis-password

# Mail
MAIL_MAILER=mailgun
MAILGUN_DOMAIN=your-domain
MAILGUN_SECRET=your-secret
```

### Step 4: Generate APP_KEY
```bash
php artisan key:generate
```

### Step 5: Run Migrations
```bash
vercel env pull .env.vercel
php artisan migrate --force
```

## 📁 Project Structure

```
eco-loop/
├── api/
│   └── index.php          # Vercel serverless entry
├── app/
│   └── ...
├── config/
│   └── ...
├── public/
│   ├── index.php          # Standard entry
│   └── ...
├── resources/
│   ├── css/
│   ├── js/
│   └── views/
├── routes/
│   ├── web.php
│   └── auth.php
├── storage/
│   └── ...
├── vercel.json            # Vercel config
├── vercel.php             # PHP runtime
├── .vercelignore          # Exclude files
├── .env.production        # Production env template
├── .gitignore             # Updated
├── vite.config.js         # Updated for Vercel
├── package.json
├── DEPLOY_VERCEL.md       # Deployment guide
└── ...
```

## 🔧 Build Command

```bash
npm install
npm run build
```

Expected output: `dist/` directory with built assets

## ⚠️ Common Issues & Solutions

### 1. Build Fails
- Clear npm cache: `npm cache clean --force`
- Delete node_modules and reinstall: `rm -rf node_modules && npm install`

### 2. APP_KEY Error
- Generate new key: `php artisan key:generate`
- Add to Vercel environment variables

### 3. Database Connection Failed
- Verify PostgreSQL credentials
- Check if database exists
- Verify SSL settings if required

### 4. 500 Error on Pages
- Set `APP_DEBUG=true` temporarily
- Check Vercel function logs
- Verify storage permissions

### 5. Static Assets 404
- Ensure `dist/` directory is created
- Check `vercel.json` outputDirectory setting
- Verify asset paths in blade templates

## 🎯 Features to Test After Deploy

- [ ] Landing page loads correctly
- [ ] User registration & login
- [ ] Product listing
- [ ] Add to cart functionality
- [ ] Checkout process
- [ ] Payment gateway integration
- [ ] Admin dashboard
- [ ] Leaderboard page
- [ ] Notification system
- [ ] Message/chat functionality
- [ ] File uploads (images)
- [ ] Email notifications

## 📞 Support

- Vercel Documentation: https://vercel.com/docs
- Laravel Documentation: https://laravel.com/docs
- Eco-Loop GitHub Issues

---

**Last Updated:** August 2026
**Version:** 1.0.0
