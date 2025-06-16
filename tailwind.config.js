module.exports = {
  content: [
    './public/**/*.php',
    './app/Views/**/*.php',
    './app/Controllers/**/*.php'
  ],
  theme: {
    extend: {
       colors: {
        primary: '#13425B',   // Azul oscuro → botones, headers
        secondary: '#F38C4E', // Naranja → acentos, hovers
        accent: '#F27174',    // Rojo coral → botones de alerta, CTA
        neutral: '#D8D8D8',   // Gris claro → bordes, fondos sutiles
        base: '#EAF4DC',      // Verde pastel → fondo general
      },
    },
  },
  plugins: [
    function({ addBase, theme }) {
      addBase({
        'a': { color: theme('colors.secondary') },
        'a:hover': { color: theme('colors.primary') },
      })
    }
  ],
};