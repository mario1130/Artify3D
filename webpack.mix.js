const mix = require('laravel-mix');

mix.js('resources/js/app.jsx', 'public/js/app.js')
   .js('resources/js/carousel.jsx', 'public/js/carousel.js')
   .js('resources/js/landing.jsx', 'public/js/landing.js')
   .react()
   .sass('resources/css/app.scss', 'public/css')
   .version();