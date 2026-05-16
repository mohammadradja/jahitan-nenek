import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],

    theme: {
        extend: {
            colors: {
                'vintage-cream': '#FDFCF9',
                'soft-rose': '#E8A0BF',
                'dark-wool': '#2D2420',
                'accent': '#E8A0BF',
            },
            fontFamily: {
                'serif': ['"Playfair Display"', 'serif'],
                'sans': ['Outfit', 'sans-serif'],
                'outfit': ['Outfit', 'sans-serif'],
                'poppins': ['Poppins', 'sans-serif'],
            },
            borderRadius: {
                '4xl': '2rem',
                '5xl': '2.5rem',
            }
        },
    },

};
