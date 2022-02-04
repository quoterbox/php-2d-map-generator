const mix = require('laravel-mix');

mix.setPublicPath('./src/public/dist/');

// minification parameters
mix.options({
    terser: {
        terserOptions: {
            compress: {
                drop_console: true,
                booleans_as_integers: true
            },
            mangle: true,
            output: {
                comments: false
            }
        },
    }
});

// main app vue js
mix.js('./src/frontend/js/app.js', './src/public/dist/js/app.min.js').vue();

// plugins and customers styles
mix.sass('./src/frontend/scss/plugins.scss', './src/public/dist/css/plugins.min.css')
    .sass('./src/frontend/scss/style.scss', './src/public/dist/css/style.min.css').version();
