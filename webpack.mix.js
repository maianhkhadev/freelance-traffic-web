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

mix.browserSync('127.0.0.1:8000')

mix.webpackConfig({
 module: {
   rules: [{
     test: /\.(png|jpe?g|gif)$/,
     loader: 'file-loader',
     options: {
         name: 'images/[name].[hash].[ext]',
         publicPath: '/'
     }
   }]
 }
})

mix.js('resources/assets/js/app.js', 'public/js').extract(['vue'])
mix.js('resources/assets/js/members.show.js', 'public/js')
mix.js('resources/assets/js/tasks.create.js', 'public/js')
mix.sass('resources/assets/scss/app.scss', 'public/css')
mix.sass('resources/assets/scss/layout.default.scss', 'public/css')
mix.sass('resources/assets/scss/pages.login.scss', 'public/css')
mix.sass('resources/assets/scss/home.scss', 'public/css')
mix.sass('resources/assets/scss/pages.index.scss', 'public/css')
mix.sass('resources/assets/scss/pages.show.scss', 'public/css')
mix.sass('resources/assets/scss/pages.edit.scss', 'public/css')
mix.sass('resources/assets/scss/tasks.create.scss', 'public/css')
