const defaultTheme = require('tailwindcss/defaultTheme')
const plugin = require('tailwindcss/plugin')
const postcss = require('postcss')

let fonts = {
  title: defaultTheme.fontFamily.sans,
  'title-wf': [],
  prose: defaultTheme.fontFamily.serif,
  'prose-wf': [],
}

module.exports = {
  theme: {
    screens: {
      xs: ( 448/16) + 'em',
      sm: ( 900/16) + 'em',
      md: (1188/16) + 'em',
      lg: (1920/16) + 'em',
    },
    colors: {
      transparent: defaultTheme.colors.transparent,
      black: defaultTheme.colors.black,
      white: defaultTheme.colors.white,
      inherit: 'inherit',
      brand: {},
    },
    extend: {
      container: {
        center: true,
        padding: '1.5rem',
      },
      fontFamily: {
        title: fonts.prose,
        'title-wf': fonts['title-wf'].concat(fonts.prose),
        prose: fonts.prose,
        'prose-wf': fonts['prose-wf'].concat(fonts.prose),
      },
    },
  },
  variants: {
    accessibility: ['responsive', 'focus', 'no-js'],
    display: ['responsive', 'no-js'],
    fontSmoothing: ['retina'],
    margin: ['responsive', 'last'],
    padding: ['responsive', 'last'],
  },
  plugins: [
    plugin(function({ addVariant, e }) {
      addVariant('retina', ({ container, separator }) => {
        const retinaRule = postcss.atRule({ name: 'media', params: '(-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi)' })
        retinaRule.append(container.nodes)
        container.append(retinaRule)
        retinaRule.walkRules(rule => {
          rule.selector = `.${e(`retina${separator}${rule.selector.slice(1)}`)}`
        })
      })
    }),
    plugin(function({ addVariant, e }) {
      addVariant('no-js', ({ modifySelectors, separator }) => {
        modifySelectors(({ selector }) => {
          return `.has-no-js .${e(`no-js${separator}`)}${selector.slice(1)}`
        })
      })
    }),
  ],
}
