const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require("tailwindcss/colors");

/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
      './resources/views/**/*.blade.php',
      './src/**/*.php',
      './resources/js/**/*.js',
  ],
    darkMode : 'class',
  theme: {
    extend: {
        fontFamily: {
            sans: ['Figtree', ...defaultTheme.fontFamily.sans],
        },
        colors: {
            'primary-datepicker' : colors.yellow,
            primary : colors.emerald,
            secondary : colors.lime,
            info : {...colors.cyan,...{DEFAULT : "#009399"}} ,
            error : {...colors.rose,...{DEFAULT : "#d7035f"}},
            warning : colors.yellow,
            success : {...colors.emerald,...{DEFAULT : "#028248"}},
            primaire : '#f46316',
            danger : '#d7035f'
        },
        keyframes :{
            transop : {
                '0%' : { transform : 'translateX(100%)', opacity : 0},
                '100%' : { transform : 'translateX(0)', opacity : 1},
            }
        },
        animation : {
            notif : 'transop 0.2s ease-in-out'
        }

    },
  },
  plugins: [require('@tailwindcss/forms')],
}

