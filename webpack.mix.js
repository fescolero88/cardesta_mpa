let mix = require('laravel-mix');

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

const ImageminPlugin = require('imagemin-webpack-plugin').default;
const CopyWebpackPlugin = require('copy-webpack-plugin');
const imageminMozjpeg = require('imagemin-mozjpeg');

mix.webpackConfig({
    plugins: [
        new CopyWebpackPlugin([{
            from: 'resources/assets/images',
            to: 'images', // Laravel mix will place this in 'public/images'
        }]),
        new ImageminPlugin({
            test: /\.(jpe?g|png|gif|svg)$/i,
            plugins: [
                imageminMozjpeg({
                    quality: 80,
                })
            ]
        })
    ]
})

.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css')
    // front end
   .combine([
       './resources/assets/frontend/js/menu.js',
       //'./resources/assets/frontend/js/jquery-v1.12.4.js',
       './resources/assets/frontend/js/markerclusterer.js'
   ], 'public/js/home.js')
.combine([
    './resources/assets/frontend/js/modernizr.js',
    './resources/assets/frontend/js/jquery.menu-aim.js',
    './resources/assets/frontend/js/main.js',
    './resources/assets/frontend/js/jquery.nicescroll.min.js',
], 'public/js/list.js')
    .sass('./resources/assets/frontend/style.scss', 'public/css/all.css');