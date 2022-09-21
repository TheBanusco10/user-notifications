const archiver = require('archiver');
const fse = require("fs-extra");
const fs = require('fs');
const {performance} = require('perf_hooks');

const destPath = './dist/usernotifications.zip';
const provisionalPath = 'provisional/';

const files = ['composer.json', 'composer.lock', 'user-notifications.php', 'README.md'];
const folders = ['vendor', 'src'];

const createBuild = () => {
    const startTime = performance.now();

    console.log('Copying files to a provisional folder...');

    if (fs.existsSync(provisionalPath)) fs.rmSync(provisionalPath, {recursive: true, force: true});
    fs.mkdirSync(provisionalPath);

    files.forEach(el => {
        fs.copyFileSync(el, `${provisionalPath}${el}`);
    });

    folders.forEach(el => {
        fse.copySync(el, `${provisionalPath}${el}`, {overwrite: true});
    });

    let endTime = performance.now();

    console.log(`Files copied in ${((endTime - startTime) / 1000).toFixed(2)} seconds`);

    console.log('Creating zip for plugin...');

    const output = fs.createWriteStream(destPath);
    const archive = archiver('zip', {
        zlib: {level: 9}
    });

    output.on('close', function () {
        console.log(archive.pointer() + ' total bytes');
        console.log('archiver has been finalized and the output file descriptor has closed.');
        endTime = performance.now();

        console.log(`Zip created in ${((endTime - startTime) / 1000).toFixed(2)} seconds`);
        fs.rmSync(provisionalPath, {recursive: true, force: true});
    });

    archive.pipe(output);
    archive.directory(provisionalPath, false);
    archive.finalize();
}

try {
    createBuild();
} catch (err) {
    console.error(err.message);
}