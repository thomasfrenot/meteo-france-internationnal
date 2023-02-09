const webpack = require("webpack");
const path = require("path");
const HtmlWebpackPlugin = require('html-webpack-plugin')

let config = {
    mode: 'development',
    entry: [
        './src/index.js',
        './src/sass/app.scss'
    ],
    output: {
        filename: './js/main.js',
        path: path.resolve(__dirname, "./dist")
    },
    module: {
        rules: [
            {
                test: /\.scss$/i,
                use: [
                    {
                        loader: 'file-loader',
                        options: {
                            name: 'css/app.css'
                        }
                    },
                    'sass-loader'
                ]
            }
        ]
    },
    devServer: {
        static: {
            directory: path.join(__dirname, 'dist'),
        },
        compress: true,
        port: 8080,
    },
    plugins: [
        new HtmlWebpackPlugin({
            template: './src/index.html'
        })
    ]
}

module.exports = config;
