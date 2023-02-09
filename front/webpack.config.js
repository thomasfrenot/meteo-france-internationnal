const webpack = require("webpack");
const path = require("path");
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');
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
    plugins: [
        new BrowserSyncPlugin({
            host: 'localhost',
            port: 3000,
            server: {
                baseDir: ['dist']
            },
            reload: false
        }),
        new HtmlWebpackPlugin({
            template: './src/index.html'
        })
    ]
}

module.exports = config;
