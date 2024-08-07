const sh = require("shelljs");
const upath = require("upath");
const { wpTheme } = require("./config");
const destPath = upath.resolve(upath.dirname(__filename), "../" + wpTheme);

/**
 * ワードプレスに必要なfunctions.phpと/inc/内のphpファイル以外を削除する
 */
sh.find(`${destPath}/*`)
  .filter((file) => !file.match(/(\/inc\/|\/inc$|functions\.php$)/))
  .map((file) => sh.rm("-rf", file));
