const fs = require('fs');
const path = require('path');

const src = 'D:\\Workspace\\project\\个人项目\\CodeManager\\app\\zentao';
const dst = 'C:\\ZenTao\\app\\zentao';

function copyDir(srcDir, dstDir) {
  if (!fs.existsSync(dstDir)) {
    fs.mkdirSync(dstDir, { recursive: true });
  }
  const entries = fs.readdirSync(srcDir, { withFileTypes: true });
  for (const entry of entries) {
    const srcPath = path.join(srcDir, entry.name);
    const dstPath = path.join(dstDir, entry.name);
    if (entry.isDirectory()) {
      copyDir(srcPath, dstPath);
    } else {
      fs.copyFileSync(srcPath, dstPath);
    }
  }
}

console.log('Syncing...');
copyDir(src, dst);
console.log('Sync complete');
