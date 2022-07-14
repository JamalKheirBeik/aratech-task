/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
    ],
    theme: {
        extend: {
            height: {
                330: "330px",
                400: "400px",
                500: "500px",
                600: "600px",
                665: "665px",
            },
        },
        screens: {
            mobile: { max: "600px" },
            pc: "600px",
        },
    },
    plugins: [],
};
