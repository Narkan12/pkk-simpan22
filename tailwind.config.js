/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
    ],
    
    

    theme: {
        extend: {
            colors: {
                'hijau-tua': '#1e5b2e',
                'hijau-muda': '#2d7a3e',
                'hijau-bg': '#f0f5f1',
                'abu-gelap': '#1c2834',
            },
            fontFamily: {
                'sans': ['Segoe UI', 'Tahoma', 'Geneva', 'Verdana', 'sans-serif'],
            }
        }
    },
    plugins: [],
}