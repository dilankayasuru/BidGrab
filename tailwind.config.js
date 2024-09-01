/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './public/index.php',
        './app/views/pages/**/*.{html,js,php}',
        './app/views/components/**/*.{html,js,php}'
    ],
    theme: {
        screens: {
            '2xl': {'max': '1535px'},
            'xl': {'max': '1279px'},
            'lg': {'max': '1023px'},
            'md': {'max': '767px'},
            'sm': {'max': '639px'},
        },
        fontFamily: {
            sans: ['Inter', 'sans-serif'],
            serif: ['Roboto', 'serif'],
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
            'yellow': "#FE8F13",
            "red": "#F46969",
            "star": "#EBC351",
        },
        extend: {
            backgroundImage: {
                'hero-pattern': "url('../../public/images/heroPattern.svg')",
                'footer-pattern': "url('../../public/images/footerPattern.svg')",
            }
        },
    },
    plugins: [],
}

