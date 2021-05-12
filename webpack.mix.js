const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js');
mix.js('resources/js/cms/app.js', 'public/js/cms');


mix.sass('resources/sass/layouts/simple.scss', 'public/css')
    .options({
        processCssUrls: false
    });

mix.sass('resources/sass/app.scss', 'public/css')
    .options({
        processCssUrls: false
    });

mix.sass('resources/sass/cms/app.scss', 'public/css/cms')
    .options({
        processCssUrls: false
    });