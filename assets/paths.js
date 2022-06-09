// paths.js
// configuration for gulpfile.js

var paths = {};

// Config
paths.config = {};
paths.config.minify_suffix = '.min';


// Directories
paths.directories = {};
paths.directories.build = '../web/build/';



//
// Tasks
//
paths.tasks = {
  css: {
    default: {
      source: 'css/main.css',
      destination: 'style.css',
      tailwind_config: 'tailwind.config.js',
      watch: [
        'css/**/*.css',
        'tailwind.config.js',
      ],
    },
  },
  purge: {
    default: {
      source: paths.directories.build + 'style.css',
      destination: 'style.purged.css',
      config: {
        content: [
          '../templates/**/*.{twig,html}',
          paths.directories.build + '**/*.js',
        ],
        defaultExtractor: content => content.match(/[\w-/.:]+(?<!:)/g) || [],
        safelist: {
          deep: [
            /wf-active/,
            /richtext/,
          ],
        },
      },
      watch: [
        paths.directories.build + 'style.css',
        paths.directories.build + '**/*.js',
        '../templates/**/*.{twig,html}',
      ],
      watch_config: {
        ignored: '../templates/_manifest*.json',
      },
    },
  },
  js: {
    urgent: {
      source: [
        '..node_modules/fontfaceobserver/fontfaceobserver.js',
        'js/fontloader.js',
        '..node_modules/lazysizes/lazysizes.js',
        'js/lazyinit.js',
      ],
      destination: 'urgent.js',
      watch: [
        'js/fontloader.js',
        'js/lazyinit.js',
      ],
    },
    deferred: {
      source: [
        '..node_modules/pjax/pjax.min.js',
        '..node_modules/topbar/topbar.min.js',
        'js/pjaxinit.js',
      ],
      destination: 'deferred.js',
      watch: [
        'js/checkbox.js',
        'js/pjaxinit.js',
      ],
    },
  },
  hash: {
    source: paths.directories.build + '**/*.{js,css}',
    destination: 'manifest.json',
    sri: 'manifest-sri.json',
    watch: paths.directories.build + '**/*.{js,css}',
  }
};



module.exports = paths;
