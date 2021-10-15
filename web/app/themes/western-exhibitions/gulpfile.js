// ## Globals
var argv                              = require('minimist')(process.argv.slice(2));
var autoprefixer                      = require('gulp-autoprefixer');
var browserSync                       = require('browser-sync').create();
var concat                            = require('gulp-concat');
var gulp                              = require('gulp');
var imagemin                          = require('gulp-imagemin');
var rev                               = require('gulp-rev');
var sass                              = require('gulp-sass')(require('sass'));
var sourcemaps                        = require('gulp-sourcemaps');
var uglify                            = require('gulp-uglify');
var del                               = require('del');
const { src, dest, series, parallel } = require('gulp');
const postcss                         = require('postcss');
const cssnano                         = require('gulp-cssnano');
const merge                           = require('merge-stream');

// See https://github.com/austinpray/asset-builder
var manifest = require('asset-builder')('./assets/manifest.json');

// `path` - Paths to base asset directories. With trailing slashes.
// - `path.source` - Path to the source files. Default: `assets/`
// - `path.dist` - Path to the build directory. Default: `dist/`
var path = manifest.paths;

// `config` - Store arbitrary configuration values here.
var config = manifest.config || {};

// `globs` - These ultimately end up in their respective `gulp.src`.
// - `globs.js` - Array of asset-builder JS dependency objects. Example:
//   ```
//   {type: 'js', name: 'main.js', globs: []}
//   ```
// - `globs.css` - Array of asset-builder CSS dependency objects. Example:
//   ```
//   {type: 'css', name: 'main.css', globs: []}
//   ```
// - `globs.fonts` - Array of font path globs.
// - `globs.images` - Array of image path globs.
// - `globs.bower` - Array of all the main Bower files.
var globs = manifest.globs;

// `project` - paths to first-party assets.
// - `project.js` - Array of first-party JS assets.
// - `project.css` - Array of first-party CSS assets.
var project = manifest.getProjectGlobs();

// CLI options
var enabled = {
  // Enable static asset revisioning when `--production`
  rev: !argv.production,
  // Disable source maps when `--production`
  maps: !argv.production,
  // Fail styles task on error when `--production`
  failStyleTask: argv.production,
  // Fail due to JSHint warnings only when `--production`
  failJSHint: argv.production,
  // Strip debug statments from javascript when `--production`
  stripJSDebug: argv.production
};

// Path to the compiled assets manifest in the dist directory
var revManifest = `${path.dist}/assets.json`;

function clean(done) {
  del.sync([path.dist])
  done();
}

function styles(done) {
  const styleMerge = merge();
  manifest.forEachDependency('css', function(dep) {
    styleMerge.add(
      src(dep.globs, { base: 'styles' })
      .pipe(sass({ outputStyle: 'compressed' }))
      .pipe(concat(dep.name))
      .pipe(autoprefixer({ cascade: false, grid: true }))
      .pipe(rev())
    )
  });
  styleMerge
    .pipe(dest(`${path.dist}/styles`, { sourcemaps: '.' }))
    .pipe(rev.manifest(revManifest, {
      base: path.dist,
      merge: true
    }))
    .pipe(dest(path.dist));
  done();
}

function images() {
  return gulp.src(globs.images)
    .pipe(imagemin([
      imagemin.mozjpeg({progressive: true}),
      imagemin.gifsicle({interlaced: true}),
      imagemin.optipng({optimizationLevel: 5}),
      imagemin.svgo({plugins: [{removeUnknownsAndDefaults: false}, {cleanupIDs: false}]})
    ]))
    .pipe(gulp.dest(`${path.dist}/images`));
    // .pipe(browserSync.stream());
}

function scripts(done) {
  const scriptMerge = merge();
    manifest.forEachDependency('js', function(dep) {
      scriptMerge.add(
        gulp.src(dep.globs, { base: 'scripts' })
        .pipe(concat( dep.name ))
        .pipe(uglify())
        .pipe(rev())
      )
    })
    scriptMerge
      .pipe(dest(`${path.dist}/scripts`, { sourcemaps: '.' }))
      .pipe(rev.manifest(revManifest, {
        base: path.dist,
        merge: true
      }))
      .pipe(dest(path.dist))
  done();
}

exports.default = series(clean, scripts, styles, images);
exports.scripts = series(clean, scripts)
