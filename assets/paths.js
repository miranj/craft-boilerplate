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
      nested_config: {
        bubble: ['screen'],
      },
      watch: [
        'css/**/*.css',
        'tailwind.config.js',
        paths.directories.build + '**/*.js',
        '../templates/**/*.{twig,html}',
      ],
      watch_config: {
        ignored: '../templates/_manifest*.json',
      },
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
        defaultExtractor: (content) =>
          content.match(/[\w-/,.%@&:\(\)\{\}\[\]!]+(?<!:)/g) || [],
        safelist: {
          deep: [/richtext/, /pswp/],
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
      source: ['../node_modules/lazysizes/lazysizes.js', 'js/lazyinit.js'],
      destination: 'urgent.js',
      watch: ['js/lazyinit.js'],
    },
    deferred: {
      source: [
        '../node_modules/@alpinejs/collapse/dist/cdn.js',
        '../node_modules/alpinejs/dist/cdn.js',
      ],
      destination: 'deferred.js',
      watch: ['../node_modules/alpinejs/dist/cdn.js'],
    },
    instant: {
      es6: true,
      source: ['../node_modules/instant.page/instantpage.js'],
      destination: 'instant.js',
      watch: ['../node_modules/instant.page/instantpage.js'],
    },
    photoswipe: {
      es6: true,
      source: ['../node_modules/photoswipe/dist/photoswipe.esm.js'],
      destination: 'photoswipe.js',
      watch: ['../node_modules/photoswipe/dist/photoswipe.esm.js'],
    },
    photoswipeLightbox: {
      es6: true,
      source: ['../node_modules/photoswipe/dist/photoswipe-lightbox.esm.js'],
      destination: 'photoswipe-lightbox.js',
      watch: ['../node_modules/photoswipe/dist/photoswipe-lightbox.esm.js'],
    },
    photoswipeInit: {
      es6: true,
      source: ['js/photoswipeinit.esm.js'],
      destination: 'photoswipeinit.js',
      watch: ['js/photoswipeinit.esm.js'],
    },
  },
  hash: {
    source: paths.directories.build + '**/*.{js,css}',
    destination: 'manifest.json',
    sri: 'manifest-sri.json',
    watch: paths.directories.build + '**/*.{js,css}',
  },
};

module.exports = paths;
