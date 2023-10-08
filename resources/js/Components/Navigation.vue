<template>
    <nav
        class="w-full py-2 px-3 flex justify-end transition-all border-b dark:border-b-stone-700"
    >
        <ThemeSwitch />
    </nav>
</template>

<script>
import ThemeSwitch from "@/Components/ThemeSwitch.vue";

export default {
    components: {
        ThemeSwitch,
    },
};
</script>
