import { defineConfig, loadEnv } from "vite";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";
import VueDevTools from "vite-plugin-vue-devtools";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig(({ mode }) => {
    const env = loadEnv(mode, process.cwd());
    const host = env.VITE_DEV_HOST ?? "localhost";

    return {
        build: {
            outDir: "dist/build",
            manifest: "manifest.json",
        },
        plugins: [
            VueDevTools({
                appendTo: "app.ts",
            }),
            laravel({
                input: "resources/js/app.ts",
                publicDirectory: "vendor/orchestra/testbench-core/laravel/public/",
                refresh: true,
                buildDirectory: "mail-log/build",
                hotFile: "vendor/orchestra/testbench-core/laravel/public/mail-log-hot",
            }),
            vue({
                template: {
                    transformAssetUrls: {
                        // The Vue plugin will re-write asset URLs, when referenced
                        // in Single File Components, to point to the Laravel web
                        // server. Setting this to `null` allows the Laravel  plugin
                        // to instead re-write asset URLs to point to the Vite
                        // server instead.
                        base: null,

                        // The Vue plugin will parse absolute URLs and treat them
                        // as absolute paths to files on disk. Setting this to
                        // `false` will leave absolute URLs un-touched so they can
                        // reference assets in the public directory as expected.
                        includeAbsolute: false,
                    },
                },
            }),
            tailwindcss(),
        ],
        server: {
            // enable HTTPS if a key and cert are provided in the env
            host,
            port: env.VITE_DEV_PORT ?? undefined,
            https: env.VITE_DEV_KEY_PATH
                ? {
                      key: env.VITE_DEV_KEY_PATH,
                      cert: env.VITE_DEV_CERTIFICATE_PATH,
                  }
                : false,
            hmr: { host },
        },
    };
});
