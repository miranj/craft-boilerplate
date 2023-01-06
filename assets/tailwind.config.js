const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors');
const plugin = require('tailwindcss/plugin');
const postcss = require('postcss');

let fonts = {
  title: defaultTheme.fontFamily.sans,
  'title-wf': [],
  prose: defaultTheme.fontFamily.serif,
  'prose-wf': [],
};

module.exports = {
  content: ['../templates/**/*.{html,twig}', './js/**/*.js'],
  theme: {
    screens: {
      xs: 448 / 16 + 'em',
      sm: 900 / 16 + 'em',
      md: 1188 / 16 + 'em',
      lg: 1920 / 16 + 'em',
    },
    colors: {
      inherit: colors.inherit,
      current: colors.current,
      transparent: colors.transparent,
      black: colors.black,
      white: colors.white,
      brand: {},
    },
    extend: {
      container: {
        center: true,
        padding: '1.5rem',
      },
      fontFamily: {
        title: fonts.title,
        'title-wf': fonts['title-wf'].concat(fonts.title),
        prose: fonts.prose,
        'prose-wf': fonts['prose-wf'].concat(fonts.prose),
      },
    },
  },
  plugins: [
    plugin(function ({ addVariant, e }) {
      addVariant('retina', ({ container, separator }) => {
        const retinaRule = postcss.atRule({
          name: 'media',
          params:
            '(-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi)',
        });
        retinaRule.append(container.nodes);
        container.append(retinaRule);
        retinaRule.walkRules((rule) => {
          rule.selector = `.${e(
            `retina${separator}${rule.selector.slice(1)}`
          )}`;
        });
      });
    }),
    plugin(function ({ addVariant, e }) {
      addVariant('no-js', ({ modifySelectors, separator }) => {
        modifySelectors(({ selector }) => {
          return `.has-no-js .${e(`no-js${separator}`)}${selector.slice(1)}`;
        });
      });
    }),
  ],
};
