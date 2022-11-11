// Init Photoswipe.js
// es6
//
// uses:
// - https://github.com/dimsemenov/photoswipe
// - https://photoswipe.com/getting-started/

const options = {
  gallery: 'body',
  children: '.photoswipe',
  pswpModule: () => import(window.PHOTOZOOM.photoswipe.module),
};
let lightbox;
let instance;

function getLightbox() {
  if (!lightbox) {
    lightbox = import(window.PHOTOZOOM.photoswipe.lightbox).then(
      (module) => module.default
    );
  }
  return lightbox;
}

function initPhotoswipe() {
  if (
    typeof window.PHOTOZOOM === 'undefined' ||
    window.PHOTOZOOM === null ||
    !window.PHOTOZOOM.photoswipe
  ) {
    return;
  }

  if (
    window.PHOTOZOOM.photoswipe.module &&
    window.PHOTOZOOM.photoswipe.lightbox &&
    document.querySelector(options.gallery)
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
document.addEventListener('pjax:success', initPhotoswipe);
