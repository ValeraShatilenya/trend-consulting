import "./bootstrap";
import "../css/app.css";

import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";

import "vue-toastification/dist/index.css";
import Toast from "vue-toastification";

createInertiaApp({
    resolve: (name) =>
        import.meta.glob("./Pages/**/*.vue", { eager: true })[
            `./Pages/${name}.vue`
        ],
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(Toast, {})
            .mount(el);
    },
});
