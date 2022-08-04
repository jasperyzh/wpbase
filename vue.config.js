const { defineConfig } = require("@vue/cli-service");
// const path = require("path");

module.exports = defineConfig({
  transpileDependencies: true,
  // reload on .php files changes
  devServer: {
    watchFiles: ["./**/*.php"],
  },

  // remove filename-hash for enqueue production files
  filenameHashing: false,
});
