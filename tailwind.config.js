module.exports = {
    content: [
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.vue",
    ],
    theme: {
        extend: {
            fontFamily: {
                "hanken-grotesk": ["Hanken Grotesk", "sans-serif"],
            },
        },
    },
    plugins: [require("@tailwindcss/forms")],
};
