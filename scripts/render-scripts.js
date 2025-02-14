"use strict";
const fs = require("fs");
const packageJSON = require("../package.json");
const upath = require("upath");
const sh = require("shelljs");
const { wpTheme } = require("./config");

module.exports = function renderScripts() {
  const sourcePathScriptsJS = upath.resolve(
    upath.dirname(__filename),
    "../src/js/scripts.js"
  );
  const destPathScriptsJS = upath.resolve(
    upath.dirname(__filename),
    "../" + wpTheme + "/scripts.js"
  );

  const copyright = `  /*!
  * Wordpress Theme - ${packageJSON.title} v${packageJSON.version} (${
    packageJSON.homepage
  })
  * Copyright 2024-${new Date().getFullYear()} ${packageJSON.author}
  */
  `;
  const scriptsJS = fs.readFileSync(sourcePathScriptsJS);

  fs.writeFileSync(destPathScriptsJS, copyright + scriptsJS);
};
