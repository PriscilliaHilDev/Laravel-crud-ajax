module.exports = {
  content: ["./resources/**/*.blade.php",
  "./resources/**/*.js",
  "./node_modules/flowbite/**/*.js"
],
  theme: {
    extend: {},
  },
  plugins: [
    // require('@tailwindcss/typography'),
    require('@tailwindcss/forms'),
    // require('flowbite/plugin'),
    // require('@tailwindcss/line-clamp'),
    // require('@tailwindcss/aspect-ratio'),
  ],
}
