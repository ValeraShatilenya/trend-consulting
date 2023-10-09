<template>
    <Head :title="title" />
    <div
        class="min-h-screen transition-all bg-zinc-50 dark:bg-stone-800 flex flex-col items-center pb-3"
    >
        <Navigation />
        <div class="container mt-3 px-2 lg:px-0">
            <slot />
        </div>
    </div>
</template>

<script>
import { Head } from "@inertiajs/vue3";
import { getAppName } from "@/Utils";
import Navigation from "@/Components/Navigation.vue";

export default {
    components: {
        Head,
        Navigation,
    },
    props: {
        title: {
            type: String,
            default: getAppName,
        },
    },
};
</script>
