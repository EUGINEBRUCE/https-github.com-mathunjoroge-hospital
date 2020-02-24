const testFolder = 'http://127.0.0.1/papaya/mygood/';
const fs = require('fs');
fs.readdir(testFolder, (err, files) => {
  files.forEach(file => {
    console.log(file);
  });
})