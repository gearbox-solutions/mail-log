/**
 * Customizations of the PrimeVue theme
 *
 * Defaults can be found at:
 * https://primevue.org/theming/styled/#presets
 * node_modules/@primevue/themes/aura/base/index.mjs
 *
 * Get shades from https://www.tailwindshades.com/
 */

export default {
    primitive: {
        blue: {
            50: "#ECF8FD",
            100: "#D3EEFA",
            200: "#A0DAF5",
            300: "#6EC7EF",
            400: "#3BB3EA",
            500: "#179AD6",
            600: "#1483B6",
            700: "#106C96",
            800: "#0D5475",
            900: "#093D55",
            950: "#073245",
        },
    },
    semantic: {
        primary: {
            50: "{blue.50}",
            100: "{blue.100}",
            200: "{blue.200}",
            300: "{blue.300}",
            400: "{blue.400}",
            500: "{blue.500}",
            600: "{blue.600}",
            700: "{blue.700}",
            800: "{blue.800}",
            900: "{blue.900}",
            950: "{blue.950}",
        },
    },
};
