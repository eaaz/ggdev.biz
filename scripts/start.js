const concurrently = require('concurrently');
const upath = require('upath');

const browserSyncPath = upath.resolve(upath.dirname(__filename), '../node_modules/.bin/browser-sync');
const { wpTheme, wpUrl } = require('./config');

concurrently([
  { 
    command: 'node scripts/sb-watch.js', 
    name: 'WATCH', 
    prefixColor: 'bgBlue.bold' 
  },
  { 
    command: `"${browserSyncPath}" "${wpUrl}" ${wpTheme} --port 3334 -w --no-online`,
    name: 'BROWSER_SYNC', 
    prefixColor: 'bgGreen.bold',
  }
], {
  prefix: 'name',
  killOthers: ['failure', 'success'],
}).then(success, failure);

function success() {
  console.log('Success');    
}

function failure() {
  console.log('Failure');
}