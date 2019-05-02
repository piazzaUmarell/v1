let mix = require("laravel-mix");
require('laravel-mix-tailwind');

mix
    .js('resources/js/app.js', 'public/static/')
    .sass('resources/scss/app.scss', 'public/static/')
    .copy('resources/images/**/*', 'public/static/images')
    .webpackConfig({
        module: {
            rules: [
                {
                    test: /\.tsx?$/,
                    loader: "ts-loader",
                    exclude: /node_modules/
                }
            ]
        },
        resolve: {
            extensions: ["*", ".js", ".jsx", ".vue", ".ts", ".tsx"]
        }
    })
    .tailwind()
;
