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
        // Output the built index.html to `public/` and place assets under `public/build`
        outDir: 'public',
        assetsDir: 'build',
        manifest: true,
        rollupOptions: {
            input: {
                main: 'resources/js/landing.jsx'
            }
        }
    },
    server: {
        host: '127.0.0.1',
        port: 5173,
    },
});
