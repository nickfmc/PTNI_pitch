// ++ WEBPACK CONFIG TIME +++++++++++++++++++++++++++
const path = require('path');
const Fiber = require('fibers');
const GlobImporter = require('node-sass-glob-importer');
const TerserJSPlugin = require('terser-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const OptimizeCSSAssetsPlugin = require('optimize-css-assets-webpack-plugin');
// const CleanWebpackPlugin = require('clean-webpack-plugin');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');

module.exports = {
  context: path.resolve(__dirname, 'src'),
  entry: {
    site : "./site.js",
    site_header : "./site_header.js"
  },
  output: {
    path: path.resolve(__dirname, 'dist'),
    filename: "[name].bundle.js"
  },
  devtool: "cheap-module-source-map",
  module: {
    rules: [
      // {
      //   test: /\.js$/,
      //   exclude: /node_modules/,
      //   use: {
      //     loader: "babel-loader"
      //   }
      // },
      {
        test: /\.scss$/,
        use: [
          MiniCssExtractPlugin.loader,
          {
            loader: 'css-loader',
            options: {
              importLoaders: 2,
              sourceMap: true,
              url: false
            },
          },
          { 
            loader: 'postcss-loader',
            options: {
              sourceMap: true,
              ident: 'postcss',
              plugins: (loader) => [
                require('postcss-import')({ root: loader.resourcePath }),
                require('postcss-preset-env')(),
              ]
            }
          },
          { 
            loader: 'sass-loader', 
            options: {
              sourceMap: true, 
              implementation: require('sass'),
              sassOptions: {
                importer: GlobImporter()
              }
            } 
          },
        ],
        type: 'javascript/auto'
      } // ++ END scss test +++++++++++++++++
    ] // ++ END rules ++++++++++++++++++++++
  }, // ++ END modules ++++++++++++++++++++
  optimization: {
    minimizer: [new TerserJSPlugin({}), new OptimizeCSSAssetsPlugin({})],
  },
  plugins: [
    // new CleanWebpackPlugin(['dist']),
    new MiniCssExtractPlugin({
      filename: "main.bundle.css"
    }),
    new BrowserSyncPlugin(
      // BrowserSync ~CORE~ options 
      {
        host: 'localhost',
        port: 3001,
        open: false,
        notify: false,
        proxy: 'https://wpdev.localhost/',
        https: {
          key: "C:/Users/onetr/.localhost-ssl/localhost.key",
          cert: "C:/Users/onetr/.localhost-ssl/localhost.crt"
        }, 
        files: [
          {
            match: [
              '**/*.php'
            ],
            fn: function (event, file) {
              if (event === "change") {
                const bs = require('browser-sync').get('bs-webpack-plugin');
                bs.reload();
              }
            }
          }
        ]
      },
      // BrowserSync ~PLUGIN~ options
      {
        // reload: false,
        injectCss: true 
      }
    ) // ++ END browsersync ++++++++++++++++++++
  ] // ++ END plugins ++++++++++++++++++++++
}