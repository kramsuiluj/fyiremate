/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
      "./resources/**/*.blade.php",
      "./resources/**/*.js",
      "./resources/**/*.vue",
      "./node_modules/flowbite/**/*.js",
      './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
  ],
  theme: {
    extend: {
        fontFamily: {
            'daysone': ['Days One', 'sans-serif'],
            'montserrat': ['Montserrat', 'sans-serif'],
        }
    },
  },
  plugins: [
      require('@tailwindcss/forms'),
      require("daisyui"),
      require('flowbite/plugin')
  ],
}
