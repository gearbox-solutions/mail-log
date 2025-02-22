// adds the global route function for typescript detection

import { route as routeFn } from "ziggy-js";
// alternatively if ziggy-js is not configured in tsconfig.json
// import routeFn from "../../../vendor/tightenco/ziggy/src/js/index.d";

declare global {
    let route: typeof routeFn;
}

// Adds the route function as an available function to the Vue component templates type definition
// It seems the above global declaration is not enough for Volar / @vue/language-service to pick it up
// https://vuejs.org/guide/typescript/options-api.html#augmenting-global-properties

export {};

declare module "vue" {
    interface ComponentCustomProperties {
        route: typeof routeFn;
    }
}
