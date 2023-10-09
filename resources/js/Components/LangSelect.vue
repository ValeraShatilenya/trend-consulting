<template>
    <div class="bg-white rounded-full">
        <select :value="activeLocale" @change="onLangSelect">
            <option
                v-for="lang in landList"
                :key="lang.value"
                :value="lang.value"
            >
                {{ lang.name }}
            </option>
        </select>
    </div>
</template>

<script>
import { loadLanguageAsync } from "laravel-vue-i18n";
import { router } from "@inertiajs/vue3";
import { getLocale } from "@/Utils";

export default {
    data: () => ({
        activeLocale: getLocale(),
        landList: Object.freeze([
            { name: "EN", value: "en" },
            { name: "RU", value: "ru" },
        ]),
    }),
    methods: {
        onLangSelect(event) {
            const locale = event.target.value;
            router.get(route("locale", { locale }));
            this.activeLang = locale;
            loadLanguageAsync(locale);
        },
    },
};
</script>

<style lang="scss" scoped>
select {
    @apply block outline-none appearance-none transition-all pl-3 pr-8 py-1.5 text-sm text-stone-900 border rounded-full bg-transparent bg-no-repeat focus:border-stone-300 dark:bg-stone-700 dark:border-stone-600 dark:text-white dark:focus:border-stone-500;
    background-image: url("data:image/svg+xml;utf8,<svg height='24' viewBox='0 0 24 24' width='24' xmlns='http://www.w3.org/2000/svg'><path d='M7.41,8.58L12,13.17L16.59,8.58L18,10L12,16L6,10L7.41,8.58Z' /></svg>");
    background-position-x: calc(100% - 5px);
    background-position-y: center;
    &:focus {
        background-image: url("data:image/svg+xml;utf8,<svg height='24' viewBox='0 0 24 24' width='24' xmlns='http://www.w3.org/2000/svg'><path d='M7.41,15.41L12,10.83L16.59,15.41L18,14L12,8L6,14L7.41,15.41Z' /></svg>");
    }
}
.dark {
    select {
        background-image: url("data:image/svg+xml;utf8,<svg height='24' viewBox='0 0 24 24' width='24' xmlns='http://www.w3.org/2000/svg'><path d='M7.41,8.58L12,13.17L16.59,8.58L18,10L12,16L6,10L7.41,8.58Z' fill='white' /></svg>");
        &:focus {
            background-image: url("data:image/svg+xml;utf8,<svg height='24' viewBox='0 0 24 24' width='24' xmlns='http://www.w3.org/2000/svg'><path d='M7.41,15.41L12,10.83L16.59,15.41L18,14L12,8L6,14L7.41,15.41Z' fill='white' /></svg>");
        }
    }
}
</style>
