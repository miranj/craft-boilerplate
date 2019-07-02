const defaultTheme = require('tailwindcss/defaultTheme')

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
    extend: {
      fontFamily: {
        title: fonts.prose,
        'title-wf': fonts['title-wf'].concat(fonts.prose),
        prose: fonts.prose,
        'prose-wf': fonts['prose-wf'].concat(fonts.prose),
      },
      colors: {
        inherit: 'inherit',
      },
      container: {
        center: true,
      },
    },
  },
}
