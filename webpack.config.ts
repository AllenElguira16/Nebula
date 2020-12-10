import webpack, { Compiler, Configuration } from 'webpack';
import path from 'path';

class Logger {
  apply(compiler: Compiler) {
    // const logger = compiler.getInfrastructureLogger('Logger');
    const log = console.log
    const clear = console.clear
    console.log = () => {}

    compiler.hooks.beforeCompile.tap('Logger', compilation => {    
      clear();
      log('\x1b[36m%s\x1b[0m', 'Starting...');
    });

    // compiler.hooks.afterEmit.tap('Logger', compilation => {
    //   clear();
    //   log('\x1b[36m%s\x1b[0m', 'Done, waiting for changes');
    //   // compilation.hooks.
    // });

    compiler.hooks.done.tap('Logger', compilation => {
      clear();
      if(compilation.hasErrors()) {
        // log('\x1b[31m', 'Errors...')
        log(compilation.compilation.getErrors())
      } else {
        log('\x1b[36m%s\x1b[0m', 'Done, waiting for changes');
      }
    })

    compiler.hooks.compilation.tap('Logger', (compilation) => {
      clear();
      // compilation.errors
      log('\x1b[36m%s\x1b[0m', 'Bundling...')
    });

    // compiler.hooks.emit.tapAsync('Logger', (compilation) => {
    //   // compilation.hooks.erro
    // })

    // compiler.hooks.failed.tap('Logger', (error) => {
    //   clear();
    //   log('\x1b[31m', 'Errors...')
    // })
  }
}

const config: Configuration = {
  name: 'client',
  target: 'web',
  mode: 'development',
  entry: [
    'regenerator-runtime/runtime',
    path.resolve(__dirname, 'src/views', 'index')
  ],
  output: {
    path: path.resolve(__dirname, 'public'),
    publicPath: '/',
    filename: 'client.bundle.js'
  },
  resolve: {
    extensions: ['.tsx', '.ts', '.jsx', '.js']
  },
  module: {
    rules: [
      {
        test: /\.(js|ts)x?$/,
        exclude: /node_modules/,
        use: {
          loader: 'babel-loader',
        }
      },
      {
        test: /\.(s?css|sass)$/i,
        use: ["style-loader", "css-loader", "sass-loader"],
      },
      {
        test: /\.(png|jpe?g|gif)$/i,
        use: [
          {
            loader: 'url-loader'
          }
        ]
      }
    ]
  },
  plugins: [
    new webpack.NoEmitOnErrorsPlugin(),
    new Logger()
  ]
}

export default config;
