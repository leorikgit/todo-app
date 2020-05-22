var Encore = require('@symfony/webpack-encore');
var ImageminPlugin = require('imagemin-webpack-plugin').default;
var CopyWebpackPlugin = require('copy-webpack-plugin');

Encore
    // directory where all compiled assets will be stored
    .setOutputPath('public/build/')

    // what's the public path to this directory (relative to your project's document root dir)
    .setPublicPath('/assets')

    // empty the outputPath dir before each build
    .cleanupOutputBeforeBuild()

    // will output as web/build/app.js
    .addEntry('app', './assets/js/app.js')

    // allow sass/scss files to be processed
    .enableSassLoader()



    .enableSourceMaps(!Encore.isProduction())

    // create hashed filenames (e.g. app.abc123.css)
    .enableVersioning()

    .enableSassLoader({
        resolve_url_loader: false
    })

    .enablePostCssLoader()

    .addPlugin(new CopyWebpackPlugin([{
        from: 'assets/images/',
        to: 'images/'
    }]))
    .addPlugin(new ImageminPlugin({ test: /\.(jpe?g|png|gif|svg)$/i }))
;

// export the final configuration
module.exports = Encore.getWebpackConfig();