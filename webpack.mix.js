const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css')
   .copy('node_modules/choices.js/public/assets/scripts/choices.js', 'public/js/choices.js')
   .copy('node_modules/choices.js/public/assets/styles/choices.css', 'public/css/choices.css');