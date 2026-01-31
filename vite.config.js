import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'], // what to process
            refresh: true, // Auto-refresh browser when files change
        }),
        tailwindcss(), // Tailwind plugin
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'], // Prevents infinite loops when Blade views compile (Performance Opt. since don't watch/ignore files) -
        },
    },
});
