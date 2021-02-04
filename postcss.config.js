module.exports = {
    preset: [
      require('cssnano-preset-default')
    ],
    plugins: [
        require('cssnano')({
            preset: ['default', {
                discardComments: {
                    removeAll: true,
                },
            }]
        }),
    ],
};
