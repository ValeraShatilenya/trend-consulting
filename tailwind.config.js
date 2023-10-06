const colors = require("tailwindcss/colors");

/** @type {import('tailwindcss').Config} */
module.exports = {
    darkMode: "class",
    content: ["./resources/**/*.{js,jsx,ts,tsx,vue,blade.php}"],
    theme: {
        extend: {
            colors: {
                primary: colors.indigo,
                secondary: colors.stone,
            },
        },
    },
    plugins: [],
};
