# Deploy Frontend to Vercel (Eco-Loop)

This repository contains a Laravel backend and a Vite-built frontend. The instructions below prepare the frontend as a static site deployable to Vercel. The backend (PHP) should be deployed separately to a PHP-capable host if needed.

Steps to prepare and deploy:

1. Install dependencies

```bash
npm install
```

2. Build the frontend (this will produce `public/build` and generate `public/index.html`)

```bash
npm run build
```

3. Preview locally (serve `public` directory)

```bash
npx serve public
```

4. Deploy to Vercel (CLI)

```bash
npm i -g vercel
vercel login
vercel --prod
```

Or via Vercel Dashboard: Import the repository and set the Build Command to `npm run build` and Output Directory to `public`.

Notes:
- The `scripts/generate-index.js` script reads `public/build/manifest.json` and generates `public/index.html` referencing hashed assets.
- If you want the frontend to call your Laravel API, set the API base URL as an environment variable in Vercel and configure CORS on the backend.

Workaround for dependency install errors on Vercel

- Problem: Some packages (e.g., `@react-three/fiber@9.x`) may require React 19 while this project uses React 18. Vercel `npm install` can fail with ERESOLVE peer dependency errors.

- Quick workaround: this repo includes a `.npmrc` with `legacy-peer-deps=true` so Vercel will install dependencies ignoring peer dependency conflicts.

- Better fix (recommended): align package versions:
	- Option A: Downgrade `@react-three/fiber` to a version compatible with React 18, for example:

```bash
npm install @react-three/fiber@^8 --save
```

	- Option B: Upgrade `react` and `react-dom` to the versions required by your 3D packages (verify compatibility across the app).

