import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Plus Jakarta Sans', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                // Eco-Loop Theme Colors - Konsisten dengan Landing Page
                eco: {
                    green: '#22c55e',
                    'green-dark': '#16a34a',
                    'green-light': '#dcfce7',
                    emerald: '#10b981',
                    teal: '#14b8a6',
                    lime: '#84cc16',
                    amber: '#f59e0b',
                    orange: '#f97316',
                    cream: '#f5f2e8',
                    dark: '#152e1c',
                    slate: '#64748b',
                    'slate-light': '#e2e8f0',
                },
            },
        },
    },

    plugins: [forms],
};
