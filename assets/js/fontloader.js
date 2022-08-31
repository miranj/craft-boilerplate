/**
 *  fontloader.js
    
    Helps you avoid FOIT and progressively load in multiple
    sets of webfonts as asynchronous non-blocking resources.
    Apply them on the page when the fonts are ready, like so:
        
        .title-type { font-family: serif; }
        .prose-type { font-family: sans-serif; }
        
        .webfonts-active .title-type { font-family: Noto Serif, serif; }
        .webfonts-active .prose-type { font-family: Noto Sans, sans-serif; }
    
    Why bother?
    - https://miranj.in/blog/2015/collateral-damage
    - https://www.filamentgroup.com/lab/js-web-fonts.html
    
 *  Created by Prateek Rungta
    Copyright (c) 2015 Miranj Design LLP
    
 *  Font activation on load based on code from
    http://www.filamentgroup.com/lab/font-events.html
    Copyright (c) 2015 Filament Group
    
 *  Dependencies:
    - FontFaceObserver https://github.com/bramstein/fontfaceobserver
**/

(function (w) {
  'use strict';

  var fontsets = [
      {
        fonts: {},
        activeClass: 'wf-active',
        cacheKey: 'wf-cached',
      },
    ],
    timeout = 5 * 60 * 1000; // give it 5 mins before timing out

  // hasClass polyfill
  // from http://youmightnotneedjquery.com/#has_class
  function hasClass(el, className) {
    if (el.classList) {
      return el.classList.contains(className);
    }
    return new RegExp('(^| )' + className + '( |$)', 'gi').test(el.className);
  }

  function isSessionStorageSupported() {
    try {
      var mod = 'test';
      sessionStorage.setItem(mod, mod);
      sessionStorage.removeItem(mod);
      return true;
    } catch (e) {
      return false;
    }
  }

  function loadFonts(fontsets) {
    // get the first fontset
    if (fontsets.length === 0) return;
    var config = fontsets.shift();

    function activate() {
      // add a class to the document indicating the fonts have loaded
      w.document.documentElement.className += ' ' + config.activeClass;

      // set a flag to optimise future visits
      if (isSessionStorageSupported()) {
        sessionStorage.setItem(config.cacheKey, true);
      }

      // recurse over remaining fontsets
      loadFonts(fontsets);

      // fire resize event to trigger dimension recalculations
      if (window.jQuery) {
        jQuery(window).resize();
      }
    }

    // if we do not have FontFaceObserver, Promise, or ECMAScript 5, activate & fail
    if (
      !('FontFaceObserver' in w) ||
      !('Promise' in w) ||
      !('keys' in Object)
    ) {
      return activate();
    }

    // if the class is already set, we're good.
    if (hasClass(w.document.documentElement, config.activeClass)) {
      return activate();
    }

    // if the fonts are already cached by the browser, activate them
    if (
      isSessionStorageSupported() &&
      sessionStorage.getItem(config.cacheKey)
    ) {
      return activate();
    }

    // loop over font list and create an observer for each weight
    var observers = [];
    Object.keys(config.fonts).forEach(function (fontFamily) {
      config.fonts[fontFamily].forEach(function (fontProperties) {
        var new_observer = new w.FontFaceObserver(fontFamily, fontProperties);
        observers.push(new_observer.load(config.testString || null, timeout));
      });
    });
    w.Promise.all(observers).then(activate);
  }

  loadFonts(fontsets);
})(this);
