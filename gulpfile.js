var elixir = require('laravel-elixir');
require('laravel-elixir-sass-compass');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

 elixir(function(mix) {

    mix.styles([
    	'normalize.css',
    	'bootstrap.css',
        'bootstrap-switch.css',
        'animate.css',
        'custom.css'
        ], 'public/css/dashboard.css');
    
    mix.scripts([
        'jquery.noty.packaged.js',
        'dashboard.js'
        ], 'public/js/dashboard.js');

    mix.scripts([
        'jquery-2.1.4.js',
        'jquery.waypoints.js',
        'lightbox.js',
        'sticky.js',
        'slick.js',
        'jquery.form.js',
        'jquery.validate.js',
        'script.js'
        ], 'public/js/app.js');

    mix.compass("style.scss", "public/css/", {
        style: "compressed",
        modules: ['susy', 'breakpoint'],
        sass: "resources/assets/scss",
        config_file: "config.rb",
        font: "public/build/fonts",
        image: "public/images",
        javascript: "public/build/js",
        sourcemap: false
    });

    mix.version(['css/dashboard.css', 'css/style.css', 'js/dashboard.js', 'js/app.js']);

    mix.browserSync({
        proxy: 'localhost'
    });

});
