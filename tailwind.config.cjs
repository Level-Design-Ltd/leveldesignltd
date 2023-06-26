// https://tailwindcss.com/docs/configuration
module.exports = {
    content: ["./index.php", "./app/**/*.php", "./resources/**/*.{php,vue,js}"],
    theme: {
        colors: {
            Black: "#000000",
            White: "#FFFFFF",
            "Brand Dark": "#0e1129",
            "Brand Light": "#edf2f4",
            "Brand Primary": "#7759d2",
            "Brand Secondary": "#004fff",
            "Brand Tertiary": "#e2b8f6",
        },
        fontSize: {
            "Paragraph 5": "12px",
            "Paragraph 4": "16px",
            "Paragraph 3": "18px",
            "Paragraph 2": "20px",
            "Paragraph 1": "33px",
        },
        fontFamily: {},
        fontWeight: {},
        letterSpacing: false,
        lineHeight: {},
        dropCap: false,
    },
    plugins: [],
};
