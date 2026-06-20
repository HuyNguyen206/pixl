import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';
import vue from '@vitejs/plugin-vue'
import inertia from '@inertiajs/vite'

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
        vue(),
        tailwindcss(),
        inertia(),
    ],
    server: {
        host: '127.0.0.1',
        hmr: {
            host: '127.0.0.1',
        },
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
