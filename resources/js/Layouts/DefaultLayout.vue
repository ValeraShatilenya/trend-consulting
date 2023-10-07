<template>
    <Head :title="title" />
    <div class="min-h-screen bg-zinc-50 flex justify-center pt-3">
        <div class="container px-2 lg:px-0">
            <slot />
        </div>
    </div>
</template>

<script>
import { Head } from "@inertiajs/vue3";
import { getAppName } from "@/Utils";

export default {
    components: { Head },
    props: {
        title: {
            type: String,
            default: getAppName,
        },
    },
};
</script>
