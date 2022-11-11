// Init Pjax
//
// uses:
// - https://github.com/MoOx/pjax
// - http://buunguyen.github.io/topbar/
//
(function (window) {
  var disableScroll = true;
  var pjax = new Pjax({
    elements: 'a[href]:not(.no-pjax)',
    selectors: ['[data-pjax-track]', 'title', '#pjax-page', '#pjax-eval'],
    switches: {
      '[data-pjax-track]': function (oldEl, newEl, options) {
        if (oldEl.outerHTML == newEl.outerHTML) {
          // nothing has changed, continue as usual
          this.onSwitch();
        } else {
          // something has changed. Abort.
          window.location.href = options.request.responseURL;
        }
      },
    },
    cacheBust: false,
    scrollRestoration: false,
    scrollTo: disableScroll === true ? false : 0,
  });

  // Override handleResponse to treat 404 responses similar to 200 responses
  pjax._handleResponse = pjax.handleResponse;
  pjax.handleResponse = function (responseText, request, href, options) {
    if (request.status === 404) {
      return pjax._handleResponse(request.responseText, request, href, options);
    }
    return pjax._handleResponse(responseText, request, href, options);
  };

  // Fire app's main() function on a new page load
  if (window.main) {
    document.addEventListener('pjax:success', main);
  }

  // Manually scroll to the top of the page without an animation
  if (disableScroll) {
    document.addEventListener('pjax:complete', function () {
      // don't change anything if the new location points to an anchor on the page
      var hash = window.document.location.hash;
      if (hash && document.querySelector(hash)) {
        return;
      }

      var oldScrollBehavior =
        window.document.documentElement.style.scrollBehavior;
      window.document.documentElement.style.scrollBehavior = 'auto';
      window.requestAnimationFrame(function () {
        window.scrollTo(0, 0);
        // restore previous scroll behavior after 2 frames
        window.requestAnimationFrame(function () {
          window.requestAnimationFrame(function () {
            window.document.documentElement.style.scrollBehavior =
              oldScrollBehavior;
          });
        });
      });
    });
  }

  // Loading progress indicator
  topbar.config({
    barThickness: 1,
    barColors: {
      0: '#000000',
      1: '#000000',
    },
    shadowBlur: 3,
  });
  document.addEventListener('pjax:send', topbar.show);
  document.addEventListener('pjax:complete', topbar.hide);
})(this);
