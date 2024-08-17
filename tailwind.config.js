/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ['./pages/**/*.{html,js,php}', './components/**/*.{html,js,php}'],
  theme: {
    fontFamily: {
      sans: ['Inter', 'sans-serif'],
      serif: ['Merriweather', 'serif'],
    },
    colors: {
      'blue': '#3D63DD',
      'blue-500': '#3D63DD40',
      'blue-800': '#3D63DDE6',
      'darkBlue': "#00318F",
      'black': "#1E1E1E",
      'gray': "#8B8D98",
      'white': "#FFFFFF",
      'fadeWhite': "#F8F9F9",
      'green': "#07B149",
      'yello': "#FE8F13",
      "red": "#F46969"
    },
    extend: {
      backgroundImage: {
        'hero-pattern': "url('./public/images/heroPattern.svg')",
        'footer-pattern': "url('./public/images/footerPatern.svg')",
      }
    },
  },
  plugins: [],
}

