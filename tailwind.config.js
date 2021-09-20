const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    mode: 'jit',
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                brown: {
                    '50': '#ffdcc2',
                    '100': '#ffd1ad',
                    '200': '#ffc599',
                    '300': '#eda268',
                    '400': '#da7e37',
                    '500': '#c06722',
                    '600': '#a85311',
                    '700': '#8f3e00',
                    '800': '#713200',
                    '900': '#522500',
                }
            }
        },
    },

    variants: {
        extend: {
            opacity: ['disabled'],
        },
    },

    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/line-clamp'),
        require('@tailwindcss/aspect-ratio'),
    ],
};
