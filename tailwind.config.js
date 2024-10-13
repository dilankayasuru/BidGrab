/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './public/**/*.{html,js,php}',
        './app/views/**/*.{html,js,php}',
    ],
    theme: {
        extend: {
            backgroundImage: {
                'hero-pattern': "url('../../public/images/heroPattern.svg')",
                'footer-pattern': "url('../../public/images/footerPattern.svg')",
            },
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
                'white-15': "#FFFFFF15",
                'fadeWhite': "#F8F9F9",
                'green': "#07B149",
                'yellow': "#FE8F13",
                "red": "#F46969",
                "star": "#EBC351",
                "orange": "#FE8F13",
            },
            keyframes: {
                revealIn: {
                    '0%': {transform: 'translateY(-300%)'},
                    '100%': {transform: 'translateY(0)'},
                },
                close: {
                    '0%': {width: '0'},
                    '100%': {width: '100%'},
                }
            },
            animation: {
                revealIn: 'revealIn 0.5s ease-in-out',
                close: 'close 5s ease-in-out',
            }
        },
    },
    plugins: [],
}

