<template>
    <nav
        class="w-full py-2 px-3 flex justify-between transition-all border-b dark:border-b-stone-700"
    >
        <LangSelect />
        <ThemeSwitch />
    </nav>
</template>

<script>
import ThemeSwitch from "@/Components/ThemeSwitch.vue";
import LangSelect from "@/Components/LangSelect.vue";

export default {
    components: {
        ThemeSwitch,
        LangSelect,
    },
};
</script>
