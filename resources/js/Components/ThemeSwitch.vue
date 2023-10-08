<template>
    <div>
        <input type="checkbox" id="darkmode-toggle" v-model="checkbox" />
        <label for="darkmode-toggle">
            <SunIcon class="sun" />
            <MoonIcon class="moon" />
        </label>
    </div>
</template>

<script>
import SunIcon from "./Icons/SunIcon.vue";
import MoonIcon from "./Icons/MoonIcon.vue";

export default {
    components: { SunIcon, MoonIcon },
    data() {
        const theme = localStorage.theme || "light";
        return {
            checkbox: theme === "dark",
            theme,
        };
    },
    watch: {
        checkbox() {
            this.toggleTheme();
            localStorage.theme = this.theme;
        },
    },
    beforeMount() {
        this.changeDocumentTheme();
    },
    methods: {
        toggleTheme() {
            this.theme = this.theme === "dark" ? "light" : "dark";
            this.changeDocumentTheme();
        },
        changeDocumentTheme() {
            if (this.theme === "dark") {
                document.documentElement.classList.add("dark");
            } else {
                document.documentElement.classList.remove("dark");
            }
        },
    },
};
</script>

<style lang="scss" scoped>
label {
    @apply block w-[4.5rem] h-8 relative bg-white transition-all duration-300 cursor-pointer rounded-full box-content border dark:border-stone-600;
    &:after {
        @apply content-[''] absolute top-1 left-1 w-6 h-6 rounded-full transition-all duration-300;
        background: linear-gradient(180deg, #ffcc89, #d8860b);
    }
    &:active:after {
        @apply w-1/2;
    }
    svg {
        @apply absolute z-10 w-4 top-2;
        &.sun {
            @apply fill-white left-2 transition-all duration-300;
        }
        &.moon {
            @apply fill-stone-400 right-2 transition-all duration-300;
        }
    }
}
input {
    @apply w-0 h-0 invisible hidden;
    &:checked + label {
        &:after {
            @apply -translate-x-full left-[calc(100%-0.25rem)];
            background: linear-gradient(180deg, #777, #3a3a3a);
        }
        @apply bg-stone-700;
        svg {
            &.sun {
                @apply fill-stone-400;
            }
            &.moon {
                @apply fill-white;
            }
        }
    }
}
</style>
