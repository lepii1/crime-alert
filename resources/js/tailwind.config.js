/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        // Tambahkan path ke folder views Anda jika berbeda, misal:
        // "./resources/views/admin/**/*.blade.php",
        // "./resources/views/auth/**/*.blade.php",
    ],
    theme: {
        extend: {},
    },
    plugins: [
        require('@tailwindcss/forms'), // PENTING: Plugin untuk merapikan input
    ],
}
