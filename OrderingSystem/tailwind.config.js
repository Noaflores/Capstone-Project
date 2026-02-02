import defaultTheme from 'tailwindcss/defaultTheme'
import forms from '@tailwindcss/forms'

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
        './resources/js/**/*.vue',
    ],

    safelist: [
        // Button colors
        'bg-blue-600',
        'hover:bg-blue-700',
        'bg-green-600',
        'hover:bg-green-700',
        'bg-purple-600',
        'hover:bg-purple-700',

        // Card / container heights
        'min-h-[500px]',

        // Widths for buttons / containers
        'w-80',
        'w-full',
        'max-w-md',
        'max-w-4xl',
        'max-w-5xl',

        // Font sizes
        'text-xl',
        'text-2xl',
        'text-4xl',

        // Padding / margins (if dynamic in components)
        'p-6',
        'p-8',
        'py-5',
        'px-8',
        'py-6',
        'px-4',
        'mt-4',
        'mt-6',
        'mb-4',
        'mb-12',
        'space-y-6',
        'space-x-4',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'custom-green': '#A0C878',
            },
        },
    },

    plugins: [forms],
}
