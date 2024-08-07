"use strict";
const fs = require("fs");
const packageJSON = require("../package.json");
const upath = require("upath");
const sh = require("shelljs");
const { wpTheme } = require("./config");

module.exports = function renderScripts() {
  const sourcePath = upath.resolve(upath.dirname(__filename), "../src/js");
  const destPath = upath.resolve(
    upath.dirname(__filename),
    "../" + wpTheme + "/."
  );

  sh.cp("-R", sourcePath, destPath);

  const sourcePathScriptsJS = upath.resolve(
    upath.dirname(__filename),
    "../src/js/scripts.js"
  );
  const destPathScriptsJS = upath.resolve(
    upath.dirname(__filename),
    "../" + wpTheme + "/scripts.js"
  );

  const copyright = `/*!
  * Wordpress Theme - ${packageJSON.title} v${packageJSON.version} (${
    packageJSON.homepage
  })
  * Copyright 2021-${new Date().getFullYear()} ${packageJSON.author}
  */
  `;
  const scriptsJS = fs.readFileSync(sourcePathScriptsJS);

  fs.writeFileSync(destPathScriptsJS, copyright + scriptsJS);
};
