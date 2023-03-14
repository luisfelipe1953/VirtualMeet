import { defineConfig } from 'vite';
import laravel, { refreshPaths } from 'laravel-vite-plugin';



export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/tags.js',
                'resources/js/ponent.js',
                'resources/js/horas.js',
                'resources/js/tags.js',
                'resources/js/slider.js',
                'resources/js/mapa.js',
                'resources/js/registro.js',
                'resources/js/regalos.js',
            ],
            refresh: [
                ...refreshPaths,
                'app/Http/Livewire/**'
            ],
        }),
    ],
});

