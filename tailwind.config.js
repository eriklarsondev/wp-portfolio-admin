const defaultTheme = require('tailwindcss/defaultTheme')
const colors = require('tailwindcss/colors')

module.exports = {
  content: ['./theme/**/*.php'],
  theme: {
    container: {
      center: true,
      padding: '30px'
    },
    extend: {
      colors: {
        accent: colors.emerald[300]
      },
      fontFamily: {
        sans: [...defaultTheme.fontFamily.sans]
      }
    }
  }
}
