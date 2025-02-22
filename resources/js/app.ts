// Core
import "../css/app.css";
import AppLayout from "@/Layouts/AppLayout.vue";
import { createApp, h, type DefineComponent } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { ZiggyVue } from "../../vendor/tightenco/ziggy";

// PrimeVue
import PrimeVue from "primevue/config";
import Aura from "@primevue/themes/aura";
import PrimeVueThemeCustomizations from "@/PrimeVueThemeCustomizations";
import { definePreset } from "@primevue/themes";
import ConfirmationService from "primevue/confirmationservice";
import ToastService from "primevue/toastservice";

// Customize the PrimeVue Theme by applying our changes to the default Aura theme
const customTheme = definePreset(Aura, PrimeVueThemeCustomizations);

const appName = import.meta.env.VITE_APP_NAME || "Laravel";

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: async (name) => {
        const page = await resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob<DefineComponent>("./Pages/**/*.vue"),
        );
        page.default.layout = page.default.layout || AppLayout;
        return page;
    },
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(ConfirmationService)
            .use(PrimeVue, {
                theme: {
                    preset: customTheme,
                    options: {
                        cssLayer: {
                            name: "primevue",
                            order: "base, primevue",
                        },
                        darkModeSelector: ".dark",
                    },
                },
            })
            .use(ToastService);

        app.mount(el);
        return app;
    },
    progress: {
        color: "#179AD6",
    },
}).then(() => {});
