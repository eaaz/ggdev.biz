'use strict';
const autoprefixer = require('autoprefixer')
const fs = require('fs');
const packageJSON = require('../package.json');
const upath = require('upath');
const postcss = require('postcss')
const sass = require('sass');
const sh = require('shelljs');
const { wpTheme } = require('./config');
const stylesPath = '../src/scss/style.scss';
const destPath = upath.resolve(upath.dirname(__filename), '../' + wpTheme + '/style.css');

module.exports = function renderSCSS() {
  const results = sass.renderSync({
    data: entryPoint,
    includePaths: [
      upath.resolve(upath.dirname(__filename), '../node_modules')
    ],
  });

  const destPathDirname = upath.dirname(destPath);
  if (!sh.test('-e', destPathDirname)) {
    sh.mkdir('-p', destPathDirname);
  }

  postcss([ autoprefixer ]).process(results.css, {from: 'style.css', to: 'style.css'}).then(result => {
    result.warnings().forEach(warn => {
      console.warn(warn.toString())
    })
    fs.writeFileSync(destPath, result.css.toString());
  })
};

const entryPoint = `/*!
* Theme Name: ${packageJSON.title}
* Theme URI: ${packageJSON.homepage}
* Author: ${packageJSON.author}
* Author URI: https://dva.jp
*/
@import "${stylesPath}"
`