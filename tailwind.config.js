module.exports = {
  content: [
    './header.php',
    './footer.php',
    './404.php',
    './functions.php',
    './home.php',
    './inc/**/*.php',
    './templates/**/*.php',
    './svg/*.php',
    './src/public/svgs/**/*.svg',
    './src/**/*.vue',
  ],
  theme: {
    container: {
      center: true,
      padding: '1rem'
    },
    fontWeight: {
      normal: 400,
      bold: 600,
      extrabold: 900
    },
    extend: {
      fontFamily: {
        'sans': ['Manrope', 'Arial', 'Helvetica', 'sans-serif'],
        'display': ['Plus Jakarta Sans', 'Arial', 'Helvetica', 'sans-serif']
      },
      fontSize: {
        '8xl': '5.125rem',
      },
      lineHeight: {
        'extra-tight': 0.83
      },
      borderRadius: {
        'brand': '1.25rem'
      },
      spacing: {
        '72': '18rem',
        '84': '21rem',
        '96': '24rem',
        '128': '32rem',
        '192': '48rem',
        '256': '64rem',
        '1/1': '100%',
        '1/2': '50%',
        '1/3': '33.333334%',
        '2/3': '66.666667%'
      },
      width: {
        '1/9': '11.1111%',
        '2/9': '22.2222%',
        '3/9': '33.3333%',
        '4/9': '44.4444%',
        '5/9': '55.5555%',
        '6/9': '66.6666%',
        '7/9': '77.7777%',
        '8/9': '88.8888%',
      },
      minHeight: {
        'hero-screen': '80vh'
      },
      zIndex: {
        '-1': '-1',
      },
      maxWidth: {
        'dirtxl': '960px',
      },
      colors: {
        brand: {
          DEFAULT: '#070939',
          secondary: '#1F3543',
          tertiary: '#D6002E',
          gray: '#4D4D4D',
          black: '#000000'
        },
      }
    }
  },
  plugins: [
    require('@tailwindcss/aspect-ratio'),
    require('@tailwindcss/forms'),
    require('@tailwindcss/typography'),
  ],
};
