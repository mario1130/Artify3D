const mix = require('laravel-mix');

mix.js('resources/js/app.jsx', 'public/js')
    .react() // Habilita soporte para React
    .sass('resources/css/app.scss', 'public/css') // Opcional: para estilos SCSS
    .version(); // Habilita el versionado de archivos para producción