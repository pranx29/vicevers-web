/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./app/**/*.{html,js,php}",
    "public/index.php",
  ],
  theme: {
    extend: {
      screens: {
        'xs': "400px",
      },
      colors: {
        primary: "#181819", // Base color for primary
        secondary: "#1A1B1E", // Base color for secondary
        natural: "#101112", // Base color for natural
        contentColor1: "#D4D4D4", // Base color for text1
      },
    },
    backgroundImage: {
      "gradient-neutral-to-primary":
        "linear-gradient(to right, #181819, #101112)",
    },

    fontFamily: {
      sans: ["Nunito", "sans-serif"],
    },
    fontWeight: {
      hairline: 100,
      thin: 200,
      light: 300,
      normal: 400,
      medium: 500,
      semibold: 600,
      bold: 700,
      extrabold: 800,
      black: 900,
    },
  },
};
