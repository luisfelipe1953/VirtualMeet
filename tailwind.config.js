const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                primario: '#007df4',
                secundario: '#00c8c2',
                primarioDarken: '#0066e6',
                secundarioDarken: '#00b5b5',
                negro: '#1a1b15',
                blanco: '#FFFFFF',
                gris: '#64748B',
                grisClaro: '#f8fafc',
                grisclaro: '#566583',
                grisoscuro: '#1E293B',
                grisoscurolighten: '#323844',
                rojo: '#FF5733',
                verde: '#02db02'
            }
        },
    },

    plugins: [require('@tailwindcss/forms'), require('tailwindcss'), require('autoprefixer'), require('@tailwindcss/typography')],
};
