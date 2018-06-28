let mix = require('laravel-mix');
require('laravel-mix-tailwind');

mix.js('resources/js/app.js', 'assets/js')
    .sass('resources/scss/app.scss', 'assets/css')
    .tailwind();