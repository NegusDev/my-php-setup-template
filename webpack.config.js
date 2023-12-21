// webpack.config.js
const path = require("path");

module.exports = {
  entry: "./assets/js/main.js",
  output: {
    filename: "bundle.js",
    path: path.resolve(__dirname, "dist"),
  },
  mode: "development",
  watch: true,
};
