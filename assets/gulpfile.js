const gulp = require('gulp');
const rename = require('gulp-rename');
const paths = require('./paths');

var css_tasks = [];
var purge_tasks = [];
var js_tasks = [];
var watch_files = [];



// CSS Tasks
Object.entries(paths.tasks.css).forEach(([task_name, task_config]) => {
  const postcss = require('gulp-postcss');
  
  task_name = 'css-' + task_name;
  css_tasks.push(task_name);
  watch_files.push([task_name, task_config.watch, task_config.watch_config || {}]);
  exports[task_name] = () => {
    return gulp.src(task_config.source, { sourcemaps: true })
      .pipe(rename(task_config.destination))
      .pipe(postcss([
        require('postcss-import'),
        require('tailwindcss')(task_config.tailwind_config),
        require('postcss-nested'),
        require('postcss-calc')({ preserve: true }),
        require('autoprefixer'),
        require('postcss-inline-svg'),
      ]))
      .pipe(gulp.dest(paths.directories.build, { sourcemaps: '.' }))
    ;
  };
});



// Purge Tasks
Object.entries(paths.tasks.purge).forEach(([task_name, task_config]) => {
  const purgecss = require('gulp-purgecss');
  const cleancss = require('gulp-clean-css');
  
  task_name = 'purge-' + task_name;
  purge_tasks.push(task_name);
  watch_files.push([task_name, task_config.watch, task_config.watch_config || {}]);
  exports[task_name] = () => {
    return gulp.src(task_config.source, { sourcemaps: true, allowEmpty: true })
      .pipe(rename(task_config.destination))
      .pipe(purgecss(task_config.config))
      .pipe(gulp.dest(paths.directories.build))
      .pipe(cleancss())
      .pipe(rename({ suffix : paths.config.minify_suffix }))
      .pipe(gulp.dest(paths.directories.build, { sourcemaps: '.' }))
    ;
  };
});



// JS Tasks
Object.entries(paths.tasks.js).forEach(([task_name, task_config]) => {
  const concat = require('gulp-concat');
  const uglify = require('gulp-uglify');
  
  task_name = 'js-' + task_name;
  js_tasks.push(task_name);
  watch_files.push([task_name, task_config.watch, task_config.watch_config || {}]);
  exports[task_name] = () => {
    return gulp.src(task_config.source, { sourcemaps: true })
      .pipe(concat(task_config.destination))
      .pipe(gulp.dest(paths.directories.build))
      .pipe(uglify())
      .pipe(rename({ suffix: paths.config.minify_suffix }))
      .pipe(gulp.dest(paths.directories.build, { sourcemaps: '.' }))
    ;
  };
});



// Hash Task
function generateHash() {
  const hashsum = require('gulp-hashsum');
  
  return gulp.src(paths.tasks.hash.source)
    .pipe(hashsum({
      dest: paths.directories.build,
      filename: paths.tasks.hash.destination,
      json: true
    }))
  ;
}
function prettyHash() {
  const jsonFormat = require('gulp-json-format');
  
  return gulp.src(paths.directories.build + paths.tasks.hash.destination)
    .pipe(jsonFormat(2))
    .pipe(gulp.dest(paths.directories.build))
  ;
}
function sizeReport() {
  const sizereport = require('gulp-sizereport');
  const fs = require('fs');
  const sources = Object.entries(paths.tasks.purge)
    .concat(Object.entries(paths.tasks.js))
    .map(([_, task]) => paths.directories.build + task.destination)
  ;
  
  return gulp.src(sources)
    .pipe(sizereport({
      gzip: true,
      minifier: (contents, filepath) => {
        return fs.readFileSync(
          paths.directories.build +
          filepath.replace(/\.(css|js)$/, paths.config.minify_suffix + '.$1'),
          "utf8"
        );
      },
    }))
  ;
}
exports.hash = gulp.series(generateHash, gulp.parallel(prettyHash, sizeReport));
watch_files.push(['hash', paths.tasks.hash.watch, { ignoreInitial: true }]);



// Watch task
function watch() {
  watch_files.forEach(([task_name, task_files, task_config = {}]) => {
    gulp.watch(
      task_files,
      Object.assign({ ignoreInitial: false }, task_config),
      gulp.series(task_name)
    );
  });
}
exports.default = watch
