// webpack.mix.js

let mix = require('laravel-mix');

mix.js('assets/app.js', 'dist').setPublicPath('dist');

mix.sass('assets/app.scss', 'dist');

mix.sass('assets/home.scss', 'dist');
