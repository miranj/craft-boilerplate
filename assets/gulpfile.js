const gulp = require('gulp');
const rename = require('gulp-rename');
const paths = require('./paths');
const postcss = require('gulp-postcss');

var css_tasks = [];
var purge_tasks = [];
var js_tasks = [];
var svgo_tasks = [];
var watch_files = [];

// CSS Tasks
Object.entries(paths.tasks.css).forEach(([task_name, task_config]) => {
  task_name = 'css-' + task_name;
  css_tasks.push(task_name);
  watch_files.push([
    task_name,
    task_config.watch,
    task_config.watch_config || {},
  ]);
  exports[task_name] = () => {
    return gulp
      .src(task_config.source, { sourcemaps: true })
      .pipe(rename(task_config.destination))
      .pipe(
        postcss(
          [
            require('postcss-import'),
            task_config.tailwindcss
              ? require('@tailwindcss/postcss')
              : require('autoprefixer'),
            require('postcss-inline-svg'),
            require('postcss-nesting'),
          ].filter((plugin) => !!plugin),
        ),
      )
      .pipe(gulp.dest(paths.directories.build, { sourcemaps: '.' }));
  };
});

// Purge Tasks
Object.entries(paths.tasks.purge).forEach(([task_name, task_config]) => {
  const purgecss = require('@fullhuman/postcss-purgecss').purgeCSSPlugin;

  task_name = 'purge-' + task_name;
  purge_tasks.push(task_name);
  watch_files.push([
    task_name,
    task_config.watch,
    task_config.watch_config || {},
  ]);
  exports[task_name] = () => {
    return gulp
      .src(task_config.source, { sourcemaps: true, allowEmpty: true })
      .pipe(rename(task_config.destination))
      .pipe(postcss([purgecss(task_config.config)]))
      .pipe(gulp.dest(paths.directories.build))
      .pipe(postcss([require('cssnano')]))
      .pipe(rename({ suffix: paths.config.minify_suffix }))
      .pipe(gulp.dest(paths.directories.build, { sourcemaps: '.' }));
  };
});

// JS Tasks
Object.entries(paths.tasks.js).forEach(([task_name, task_config]) => {
  const concat = require('gulp-concat');
  const uglify = require('gulp-uglify');
  const terser = require('gulp-terser-js');

  task_name = 'js-' + task_name;
  js_tasks.push(task_name);
  watch_files.push([
    task_name,
    task_config.watch,
    task_config.watch_config || {},
  ]);
  exports[task_name] = () => {
    return gulp
      .src(task_config.source, { sourcemaps: true })
      .pipe(concat(task_config.destination))
      .pipe(gulp.dest(paths.directories.build))
      .pipe(task_config.es6 ? terser() : uglify())
      .pipe(rename({ suffix: paths.config.minify_suffix }))
      .pipe(gulp.dest(paths.directories.build, { sourcemaps: '.' }));
  };
});

// SVGO Tasks
Object.entries(paths.tasks.svgo).forEach(([task_name, task_config]) => {
  const { optimize } = require('svgo');
  const fs = require('fs');

  task_name = 'svgo-' + task_name;
  svgo_tasks.push(task_name);
  exports[task_name] = (callback) => {
    gulp
      .src(task_config.source, { allowEmpty: true })
      .on('data', (file) => {
        const optimized = optimize(file.contents.toString('utf8'), {
          path: file.path,
          ...task_config.config,
        });
        fs.writeFileSync(file.path, optimized.data);
      })
      .on('end', callback)
      .on('error', callback);
  };
});

// Hash Task
function generateHash() {
  const hashsum = require('gulp-hashsum');
  const sri = require('gulp-sri');

  return gulp
    .src(paths.tasks.hash.source)
    .pipe(
      hashsum({
        dest: paths.directories.build,
        filename: paths.tasks.hash.destination,
        json: true,
      }),
    )
    .pipe(
      sri({
        fileName: paths.tasks.hash.sri,
        transform: (hash) => {
          var output = {};
          Object.entries(hash).forEach(([filepath, sri]) => {
            output[filepath.replace(paths.directories.build, '')] = sri;
          });
          return output;
        },
        formatter: (hash) => JSON.stringify(hash, null, 2),
      }),
    )
    .pipe(gulp.dest(paths.directories.build));
}
function prettyHash() {
  const jsonFormat = require('gulp-json-format');

  return gulp
    .src(paths.directories.build + paths.tasks.hash.destination)
    .pipe(jsonFormat(2))
    .pipe(gulp.dest(paths.directories.build));
}
function sizeReport() {
  const sizereport = require('gulp-sizereport');
  const fs = require('fs');
  const sources = Object.entries(paths.tasks.purge)
    .concat(Object.entries(paths.tasks.js))
    .map(([_, task]) => paths.directories.build + task.destination);
  return gulp.src(sources, { allowEmpty: true }).pipe(
    sizereport({
      gzip: true,
      minifier: (contents, filepath) => {
        return fs.readFileSync(
          paths.directories.build +
            filepath.replace(/\.(css|js)$/, paths.config.minify_suffix + '.$1'),
          'utf8',
        );
      },
    }),
  );
}
exports.hash = gulp.series(generateHash, gulp.parallel(prettyHash, sizeReport));
watch_files.push(['hash', paths.tasks.hash.watch, { ignoreInitial: true }]);

// Build task
exports['build'] = gulp.series(
  gulp.parallel(
    gulp.series(
      css_tasks.map((task) => exports[task]),
      js_tasks.map((task) => exports[task]),
    ),
    purge_tasks.map((task) => exports[task]),
    svgo_tasks.map((task) => exports[task]),
  ),
  exports.hash,
);

// Watch task
function watch() {
  watch_files.forEach(([task_name, task_files, task_config = {}]) => {
    gulp.watch(
      task_files,
      Object.assign({ ignoreInitial: false }, task_config),
      gulp.series(task_name),
    );
  });
}
exports.default = watch;
