import "./bootstrap";
import "../css/app.css";

import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";

import "vue-toastification/dist/index.css";
import Toast from "vue-toastification";

import { i18nVue } from "laravel-vue-i18n";

createInertiaApp({
    resolve: (name) =>
        import.meta.glob("./Pages/**/*.vue", { eager: true })[
            `./Pages/${name}.vue`
        ],
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(Toast, {})
            .use(i18nVue, {
                lang: props.initialPage.props.locale,
                fallbackLang: props.initialPage.props.fallback_locale,
                resolve: (lang) => import(`./Lang/${lang}.json`),
            })
            .mount(el);
    },
});
