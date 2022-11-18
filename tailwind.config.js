const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
        },
        colors: {
            red: {
                light: '#FFEBEB',
                medium: '#EF4444',
                dark: '#991B1B',
            },
            blue: {
                light: '#F0F9FF',
                medium: '#0284C7',
                dark: '#075985',
            },
            green: {
                light: '#DCFCE7',
                medium: '#22C55E',
                dark: '#166534',
            },
            black: {
                medium: '#686868',
                dark: '#212529',
            },
            white: {
                light: '#FEFEFE',
                medium: '#F6F6F6',
                dark: '#E6E6E6',
            },
        }
    },

    plugins: [require('@tailwindcss/forms')],
};
