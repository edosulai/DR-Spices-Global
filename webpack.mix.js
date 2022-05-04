const mix = require('laravel-mix')
const path = require('path')
require('laravel-mix-purgecss')

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

mix.js('resources/js/bootstrap.js', 'js/app.js')
    .sass('resources/sass/app.scss', 'css/app.css')
    .setPublicPath('public')
    .webpackConfig(require('./webpack.config'))
    .options({
        fileLoaderDirs: {
            fonts: 'fonts',
            images: 'storage/images',
        },
        processCssUrls: false,
    })
    .sourceMaps()
    .purgeCss({
        content: [
            path.join(__dirname, 'resources/js/*.js'),
            path.join(__dirname, 'resources/views/**/*.php')
        ],
        safelist: [
            'owl-nav',
            'owl-prev',
            'owl-next',
            'nivoSlider',
            'nivo-main-image',
            'nivo-imageLink',
            'nivo-slice',
            'nivo-box',
            'nivo-html-caption',
            'nivo-directionNav',
            'nivo-prevNav',
            'nivo-nextNav',
            'nivo-controlNav',
            'nivo-control',
            'slideshow-wrapper',
            'dr-slideshow-wrapper',
            'dr-caption',
            'medium_16',
            'medium_white_18',
            'medium_yellow_16',
            'medium_24',
            'medium_20',
            'very_large_72',
            'very_large_48',
            'very_large_36',
            'very_large_30',
            'very_large_60',
            'top-bottom',
            'bottom-top',
            'left-right',
            'right-left',
            'roll',
            'zoom',
            'rotate',
            'flip-x',
            'normal',
            'slideshow',
            'nivo-caption',
            'flip-y',
            'slow',
            'greendark',
            'limedark',
            'orangedark',
            'purpledark',
            'reddark',
            'yellowdark',
            'lightbluedark',
            'cyandark',
            'greydark'
        ]
    })

if (mix.inProduction()) {
    mix.version()
}



