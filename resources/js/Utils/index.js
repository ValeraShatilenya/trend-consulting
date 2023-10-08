import { usePage } from "@inertiajs/vue3";
import { trans } from "laravel-vue-i18n";
import { useToast } from "vue-toastification";

const toast = useToast();

function getAppName() {
    return usePage().props.app_name;
}

function getQuery() {
    return usePage().props.query;
}

function getLocale() {
    return usePage().props.locale;
}

function getValueFromField(item, field) {
    return field
        .split(".")
        .reduce(
            (result, f) => (!isEmpty(result?.[f]) ? result?.[f] : null),
            item
        );
}

function isEmpty(value) {
    return typeof value === "undefined" || value === null;
}

function copyToClipboard(text) {
    navigator.clipboard.writeText(text);
    toast.success(trans("Text copied!"), {
        timeout: 2000,
    });
}

export { getAppName, getQuery, getLocale, getValueFromField, copyToClipboard };
