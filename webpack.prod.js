const webpack = require('webpack');
const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

module.exports = {
  mode: 'production',
  entry: {
    main: './src/js/main.js'
  },
  output: {
    path: path.join(__dirname, 'www/distrib'),
    filename: 'bundle.js',
    publicPath: '/distrib/',
  },
  module: {
    rules: [
      {
        test: /\.css$/, use: [
          MiniCssExtractPlugin.loader,
          'css-loader',
        ],
      },
      {
        test: /\.(scss|sass)$/, use: [
          MiniCssExtractPlugin.loader,
          'css-loader', 'sass-loader',
        ],
      },
    ],
  },
  plugins: [
    new webpack.ProvidePlugin({
      $: 'jquery',
      jQuery: 'jquery',
      'window.jQuery': 'jquery',
      'window.Dropdown': ['bootstrap','Dropdown']
    }),
    new MiniCssExtractPlugin({
      filename: 'bundle.css',
    }),
  ],
};