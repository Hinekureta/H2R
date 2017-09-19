const path = require('path');

module.exports = {
    entry: './web/js/react/index.jsx',
    output: {
        filename: 'bundle.js',
        path: path.resolve(__dirname+ '/web/js/react', 'dist')
    },
    module: {
        loaders: [
            {
                test: /\.jsx?$/,
                loader: 'babel-loader',
                exclude: /node_modules/,
                query: {
                    presets: ['react', 'es2015']
                }
            }
        ]
    }
};