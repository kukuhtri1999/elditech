import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
        './resources/js/**/*.js',
    ],

    darkMode: 'class',

    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
                sora: ['Sora', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                base:   '#0A0A0A',
                accent: '#9DFF20',
            },
            letterSpacing: {
                widest2: '0.2em',
            },
            backgroundImage: {
                'glow-accent': 'radial-gradient(ellipse at center, rgba(157,255,32,0.15) 0%, transparent 70%)',
            },
        },
    },

    plugins: [forms],
};
