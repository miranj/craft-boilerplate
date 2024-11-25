// Init Photoswipe.js
// es6
//
// uses:
// - https://github.com/dimsemenov/photoswipe
// - https://photoswipe.com/getting-started/

const options = {
  gallery: 'body',
  children: '.photoswipe',
  pswpModule: () => import(window.ProjectEnv.photoswipe.module),
};
let lightbox;
let instance;

function getLightbox() {
  if (!lightbox) {
    lightbox = import(window.ProjectEnv.photoswipe.lightbox).then(
      (module) => module.default,
    );
  }
  return lightbox;
}

function initPhotoswipe() {
  if (
    typeof window.ProjectEnv === 'undefined' ||
    window.ProjectEnv === null ||
    !window.ProjectEnv.photoswipe
  ) {
    return;
  }

  if (
    window.ProjectEnv.photoswipe.module &&
    window.ProjectEnv.photoswipe.lightbox &&
    document.querySelector(options.gallery + ' ' + options.children)
  ) {
    getLightbox()
      .then((lightbox) => {
        if (instance) {
          instance.destroy();
        }
        instance = new lightbox(options);
        return instance;
      })
      .then((instance) => {
        instance.init();
      });
  }
}

initPhotoswipe();
