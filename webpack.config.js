var config = {
    mode: "production",
    module: {
        rules: [
            {
                test: /.js$/,
                loader: "babel-loader",
                exclude: /node_modules/
            }
        ]
    }
};

var paramConditionConfig = Object.assign({}, config, {
    name: "Parameter Condition Block",
    entry: "./block/ParameterConditional.js",
    output: {
        path: __dirname,
        filename: "block/ParameterConditional.final.js"
    }
});

module.exports = [
    paramConditionConfig
];
