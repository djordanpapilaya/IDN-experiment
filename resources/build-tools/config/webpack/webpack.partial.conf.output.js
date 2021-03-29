const path = require('path');

module.exports = ({ config, isDevelopment }) => webpackConfig => ({
  ...webpackConfig,
  output: {
    path: isDevelopment
      ? path.join(config.projectRoot, 'dist')
      : path.join(path.resolve(__dirname, '../../../../'), 'public'),
    publicPath: isDevelopment ? '/' : config.dist.publicPath,
    globalObject: 'this',
    filename: isDevelopment
      ? '[name].js'
      : path.posix.join('', config.dist.versionPath + 'js/[name].js'),
    chunkFilename: isDevelopment
      ? '[id].js'
      : path.posix.join('', config.dist.versionPath + 'js/[id].js'),
  },
});
