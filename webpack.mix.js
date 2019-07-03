const mix = require('laravel-mix');

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


mix.autoload({
    jquery: ['$', 'window.jQuery', "jQuery", "window.$", "jquery", "window.jquery", "global.jquery"]
});

mix.browserSync({
    proxy: 'nailo.test'
});

mix.copy('resources/fonts', 'public/assets/fonts')
    .copy('resources/sass/images', 'public/assets/images')
    .combine(['resources/js/main/plugins.min.js','resources/js/main/script.min.js'], 'public/assets/js/app.js')
    .js('resources/js/app.js', 'public/js')
    .js('resources/provider-js/app.js', 'public/js/provider.js')
    .js('resources/seller-js/app.js', 'public/js/seller.js')
    .sass('resources/sass/app.scss', 'public/assets/css').version();

