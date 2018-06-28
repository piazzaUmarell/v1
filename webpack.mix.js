let mix = require('laravel-mix');
require('laravel-mix-tailwind');

mix.js('resources/js/app.js', 'public/assets/js')
    .sass('resources/scss/app.scss', 'public/assets/css')
    .copy('resources/img', 'public/assets/img')
    .tailwind();