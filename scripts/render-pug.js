"use strict";
const fs = require("fs");
const prettier = require("prettier");
const pug = require("pug");
const sh = require("shelljs");
const upath = require("upath");
const workerpool = require("workerpool");
const { wpTheme } = require("./config");

function renderPug(filePath) {
  const destPath = filePath
    .replace(/src\/pug\/\pages/, wpTheme)
    .replace(/\.pug$/, ".php");
  const srcPath = upath.resolve(upath.dirname(__filename), "../src");

  let html;
  try {
    html = pug.renderFile(filePath, {
      doctype: "html",
      filename: filePath,
      basedir: srcPath,
    });
  } catch (error) {
    return console.error(error);
  }

  const destPathDirname = upath.dirname(destPath);
  if (!sh.test("-e", destPathDirname)) {
    sh.mkdir("-p", destPathDirname);
  }

  const prettified = prettier.format(html, {
    printWidth: 1000,
    tabWidth: 2,
    singleQuote: true,
    proseWrap: "preserve",
    endOfLine: "lf",
    parser: "html",
    htmlWhitespaceSensitivity: "ignore",
  });

  fs.writeFileSync(destPath, prettified);
}

workerpool.worker({
  renderPug: renderPug,
});
