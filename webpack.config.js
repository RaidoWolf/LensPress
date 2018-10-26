const wplib = [
  'blocks',
  'components',
  'date',
  'editor',
  'element',
  'i18n',
  'utils',
  'data',
];

const wpJsxConfig = {
    mode: 'production',
    devtool: 'source-map',
    module: {
        rules: [
            {
                test: /.jsx?$/,
                loader: 'babel-loader',
                exclude: /node_modules/
            }
        ]
    },
    externals: wplib.reduce((externals, lib) => {
      externals[`wp.${lib}`] = {
        window: ['wp', lib],
      };

      return externals;
    }, {
      'react': 'React',
      'react-dom': 'ReactDOM',
    })
};

var paramConditionConfig = Object.assign({}, wpJsxConfig, {
    name: 'Parameter Condition Block',
    entry: './block/ParameterCondition.jsx',
    output: {
        path: __dirname,
        filename: 'block/ParameterCondition.final.js'
    }
});

var paramCaseConfig = Object.assign({}, wpJsxConfig, {
    name: 'Parameter Case Block',
    entry: './block/ParameterCase.jsx',
    output: {
        path: __dirname,
        filename: 'block/ParameterCase.final.js'
    }
});

module.exports = [
    paramConditionConfig,
    paramCaseConfig
];
