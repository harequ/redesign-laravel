var elixir = require('laravel-elixir');

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
    // mix.sass('app.scss');
    mix.styles([
    	'normalize.css',
    	'bootstrap.css',
        'bootstrap-switch.css',
        'roboto.css',
        'dashboard.css',
        'offcanvas.css',
        'custom.css'
        ]);
    
    mix.scripts([
    	'app.js',
        'bootstrap-switch.js'
        ]);

    mix.version(['css/all.css', 'js/all.js']);
});
