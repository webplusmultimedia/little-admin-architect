const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require("tailwindcss/colors");
/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
      './resources/views/**/*.blade.php',
      './resources/js/**/*.js',
  ],
  theme: {
    extend: {
        fontFamily: {
            sans: ['Figtree', ...defaultTheme.fontFamily.sans],
        },
        colors: {
            'primary-datepicker' : colors.cyan,
            primary : colors.cyan,
            secondary : colors.lime,
            info : colors.indigo,
            error : colors.red,
            warning : colors.yellow,
            success : colors.emerald,
            primaire : '#f46316'
        }
    },
  },
  plugins: [require('@tailwindcss/forms')],
}

