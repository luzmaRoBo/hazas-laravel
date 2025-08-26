// import { defineConfig } from 'vite';
// import laravel from 'laravel-vite-plugin';

// export default defineConfig({
//     plugins: [
//         laravel({
//             input: ['resources/css/app.css', 'resources/js/app.js'],
//             refresh: true,
//         }),
//     ],
// });
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    // Este es el bloque que falta
    server: {
        // Permite que Vite sea accesible desde otras máquinas (en este caso, desde tu ordenador)
        host: '0.0.0.0',
        // Configuración para el Hot Module Replacement (HMR)
        hmr: {
            host: 'localhost',
        },
    },
});