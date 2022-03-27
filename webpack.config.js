const path = require('path')
const webpack = require('webpack')

module.exports = {
    resolve: {
        alias: {
            '@': path.resolve('resources/js'),
        },
    },
    plugins: [
        new webpack.ProvidePlugin({
            $: "jquery",
            jQuery: "jquery",
            'window.jQuery': 'jquery'
        })
    ],
    module: {
        rules: [
            {
                test: /(\.(png|jpe?g|gif|webp)$|^((?!font).)*\.svg$)/,
                rules: [
                    {
                        loader: 'file-loader',
                        options: {
                            name: 'storage/[path][name].[ext]?[hash]',
                            context: 'resources/assets',
                        }
                    },
                ],
            }
        ]
    }
}
