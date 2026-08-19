#!/usr/bin/env node
import fs from 'fs/promises';
import path from 'path';

const manifestCandidates = [
  path.resolve('public/build/manifest.json'),
  path.resolve('build/manifest.json'),
];

let manifestPath = null;
let manifest = null;
for (const p of manifestCandidates) {
  try {
    const txt = await fs.readFile(p, 'utf8');
    manifest = JSON.parse(txt);
    manifestPath = p;
    break;
  } catch (e) {
    // try next
  }
}

if (!manifest) {
  console.error('Could not find manifest.json in public/build or build. Run `npm run build` first.');
  process.exit(1);
}

const preferredEntries = ['resources/js/landing.jsx', 'resources/js/app.js', 'resources/js/landing.jsx.js', 'resources/js/app.jsx'];
let entryKey = Object.keys(manifest).find(k => preferredEntries.includes(k));
if (!entryKey) entryKey = Object.keys(manifest)[0];
const entry = manifest[entryKey];

const cssLinks = (entry.css || []).map(c => `<link rel="stylesheet" href="/build/${c}">`).join('\n');
const moduleScript = `<script type="module" src="/build/${entry.file}"></script>`;

const html = `<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Eco-Loop</title>
    ${cssLinks}
  </head>
  <body>
    <div id="root"></div>
    ${moduleScript}
  </body>
</html>`;

await fs.mkdir(path.resolve('public'), { recursive: true });
await fs.writeFile(path.resolve('public/index.html'), html, 'utf8');
console.log('Wrote public/index.html using manifest at', manifestPath, 'entry', entryKey);
