import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            assets: ['resources/images/**', 'resources/fonts/**'],
            refresh: [
                'resources/views/**',
                'routes/**',
                'resources/lang/**',
            ],
        }),
        tailwindcss(),
    ],
    server: {
        watch: {
            ignored: [
                '**/storage/**',
                '**/vendor/**',
                '**/node_modules/**',
                '**/.git/**',
                '**/.env*',
                '**/logs/**',
                '**/bootstrap/cache/**',
            ],
        },
    },
});
