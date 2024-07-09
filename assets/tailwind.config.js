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
      spacing: {
        /* @link https://utopia.fyi/space/calculator?c=320,16,1.2,1240,21,1.333,6,2,&s=0.75|0.5|0.25,1.5|2|3|4|5|6|7,s-l|l-3xl|xl-4xl&g=s,l,xl,12 */

        // Scale
        '3xs': 'clamp(0.25rem, 0.2283rem + 0.1087vi, 0.3125rem)',
        '2xs': 'clamp(0.5rem, 0.4348rem + 0.3261vi, 0.6875rem)',
        xs: 'clamp(0.75rem, 0.663rem + 0.4348vi, 1rem)',
        sm: 'clamp(1rem, 0.8913rem + 0.5435vi, 1.3125rem)',
        md: 'clamp(1.5rem, 1.3261rem + 0.8696vi, 2rem)',
        lg: 'clamp(2rem, 1.7826rem + 1.087vi, 2.625rem)',
        xl: 'clamp(3rem, 2.6739rem + 1.6304vi, 3.9375rem)',
        '2xl': 'clamp(4rem, 3.5652rem + 2.1739vi, 5.25rem)',
        '3xl': 'clamp(5rem, 4.4565rem + 2.7174vi, 6.5625rem)',
        '4xl': 'clamp(6rem, 5.3478rem + 3.2609vi, 7.875rem)',
        '5xl': 'clamp(7rem, 6.2391rem + 3.8043vi, 9.1875rem)',

        // Custom Pairs
        'sm-lg': 'clamp(1rem, 0.4348rem + 2.8261vi, 2.625rem)',
        'lg-3xl': 'clamp(2rem, 0.413rem + 7.9348vi, 6.5625rem)',
        'xl-4xl': 'clamp(3rem, 1.3043rem + 8.4783vi, 7.875rem)',
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
