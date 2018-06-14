const { mix } = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/assets/js/app.js', 'public/js/app.js')
   .js('resources/assets/js/dropzone.js', 'public/js/dropzone.js')
   .copy('node_modules/pikaday/pikaday.js', 'public/js/pikaday.js')
   .sass('resources/assets/sass/app.scss', 'public/css')
   .styles('resources/assets/css/smt-bootstrap.css', 'public/css/smt-bootstrap.css')
   .styles('resources/assets/js/Pikaday-master/css/pikaday.css', 'public/css/pikaday.css');
