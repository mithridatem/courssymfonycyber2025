/** @type {import('tailwindcss').Config} */
module.exports = {
	content: [
		"./assets/vendor/preline/*.js",
		"./assets/**/*.js",
		"./templates/**/*.html.twig",
		"./src/Form/**/*.php",
	],
	theme: {
		extend: {},
	},
	plugins: [],
};
