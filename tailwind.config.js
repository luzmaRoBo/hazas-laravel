import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            fontFamily: {
                roboto: ['Roboto', 'sans-serif'],
                oswald: ['Oswald', 'sans-serif'],
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                arena: '#F5EDE1',
                oscuro: '#181f1c',
                verdeOscuro: '#274029',
                verde: '#2d6a4f',
                menta: '#52b788',
                claro: '#c2c5aa',
            },
        },
    },
    plugins: [],
};
