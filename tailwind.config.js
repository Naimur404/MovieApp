/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
      ],
  theme: {
    extend: {
      width:{
        '96': '22rem',
      }
    },
  },
  plugins: [],
}
