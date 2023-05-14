import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

let host = 'localhost';
let port = 5500;

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    server: {
        host: host,
        port: port,
        hmr: {
            host: host,
            port: port,
        },
    },
});
