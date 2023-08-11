import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            colors: {
                primary: '#F9F9FB',
                secondary: '#0F2B4B',
                accent1: '#28364C',
                accent2: '#B3BBC6',
                error: '#D62D30',
                success: '#69A042',
              },
              fontFamily: {
                primary: 'Onest',
              },
              screens: {
                '3xl': '1680px',
                xs: '420px',
              },
              backgroundImage: {
                modal: 'linear-gradient(0deg, rgba(40, 54, 76, 0.2), rgba(40, 54, 76, 0.2))',
                '404page': 'url(/img/404.png)',
              },
        },
    },

    plugins: [forms, typography],
};
