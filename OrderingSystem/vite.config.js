import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    build: {
        rollupOptions: {
            output: {
                // Force predictable filenames
                entryFileNames: 'assets/app.js',
                chunkFileNames: 'assets/app.js',
                assetFileNames: 'assets/app.css',
            },
        },
    },
});
