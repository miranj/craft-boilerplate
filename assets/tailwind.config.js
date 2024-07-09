const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors');
const plugin = require('tailwindcss/plugin');
const postcss = require('postcss');

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
      zinc: colors.zinc,
      brand: {},
    },
    fontSize: {
      /* @link https://utopia.fyi/type/calculator?c=320,16,1.2,1240,21,1.333,6,2,&s=0.75|0.5|0.25,1.5|2|3|4|6,s-l&g=s,l,xl,12 */
      xs: 'clamp(0.6944rem, 0.6791rem + 0.0769vi, 0.7387rem)',
      sm: 'clamp(0.8333rem, 0.7807rem + 0.2631vi, 0.9846rem)',
      base: 'clamp(1rem, 0.8913rem + 0.5435vi, 1.3125rem)',
      md: 'clamp(1.2rem, 1.0088rem + 0.9558vi, 1.7496rem)',
      lg: 'clamp(1.44rem, 1.1297rem + 1.5516vi, 2.3322rem)',
      xl: 'clamp(1.728rem, 1.2477rem + 2.4014vi, 3.1088rem)',
      '2xl': 'clamp(2.0736rem, 1.3535rem + 3.6007vi, 4.144rem)',
      '3xl': 'clamp(2.4883rem, 1.4324rem + 5.2794vi, 5.524rem)',
      '4xl': 'clamp(2.986rem, 1.4634rem + 7.613vi, 7.3634rem)',
    },
    extend: {
      container: {
        center: true,
        padding: '1.5rem',
      },
      fontFamily: {
        // TODO Customise font stacks by adding webfonts here
        // TODO If using webfonts, add a URL to customise the set
        title: [...defaultTheme.fontFamily.sans],
        prose: [...defaultTheme.fontFamily.serif],
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
            `retina${separator}${rule.selector.slice(1)}`,
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
