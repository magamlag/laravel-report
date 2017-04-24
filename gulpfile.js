var elixir = require('laravel-elixir');

//Enable to use webpack in Laravel 5.3
require('laravel-elixir-webpack');

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

elixir(function (mix) {
	mix.sass('app.scss');
});

elixir(function (mix) {
	mix.webpack('./resources/assets/js/invoice_header.js', './public/js/invoice_header.js');
});

elixir(function (mix) {
	mix.version(['css/app.css', 'js/invoice_header.js']);
});

elixir(function (mix) {
	mix.browserSync({
		proxy: env('APP_SITE_NAME')
	});
});