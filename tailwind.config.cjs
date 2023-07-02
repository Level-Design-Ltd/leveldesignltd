const { currentcolor } = require("caniuse-lite/data/features");

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
            "Brand Gradient Light":
                "linear-gradient(90deg,rgb(119, 89, 210) 0%,rgb(226, 184, 246) 100%)",
            "Brand Gradient Dark":
                "linear-gradient(90deg,rgb(119, 89, 210) 0%,rgb(14, 17, 41) 100%)",
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
