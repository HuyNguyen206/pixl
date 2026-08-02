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
        // vite runs inside the app container, so bind every interface rather
        // than just loopback, or the published port has nothing to forward to
        host: '0.0.0.0',
        port: 5173,
        // fail loudly instead of drifting to 5174, which would publish the
        // wrong port and write a stale URL into public/hot
        strictPort: true,
        hmr: {
            // this is what laravel-vite-plugin writes into public/hot, and it
            // has to resolve from both sides: the host browser reaches it via
            // the published port, the test browser via vite's own bind
            host: 'localhost',
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
