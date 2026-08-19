import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';

export default defineConfig({
    base: '/',
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/landing.jsx'
            ],
            refresh: true,
        }),
        react(),
    ],
    build: {
        // Output to `dist/` and place built assets under `dist/assets`
        outDir: 'dist',
        assetsDir: 'assets',
        manifest: true,
        // Use HTML entry so Vite outputs `dist/index.html` with correct hashed asset paths
        rollupOptions: {
            input: 'index.html'
        }
    },
    server: {
        host: '127.0.0.1',
        port: 5173,
    },
});
