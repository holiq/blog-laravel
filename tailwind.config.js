module.exports = {
  purge: [
    './resources/views/**/*.blade.php',
    './resources/css/**/*.css',
    './resources/sass/**/*.scss',
  ],
  theme: {
    extend: {}
  },
  variants: {
    tableLayout: ['responsive', 'hover', 'focus'],
    textDecoration: ['responsive', 'hover', 'focus', 'active', 'group-hover'],
  },
  plugins: [
    require('@tailwindcss/ui'),
  ],
  corePlugins: {
  }
}