<template>
    <ul v-show="data.last_page !== 1" class="hidden md:flex">
        <Link
            v-for="({ url, label, active }, index) in data.links"
            :key="index"
            :class="{
                active,
                dots: label === DOTS,
                disabled: !url,
            }"
            :href="url || ''"
            as="li"
            type="button"
            preserve-state
        >
            <div v-if="index === 0">
                <SvgIcon type="mdi" :path="icons.mdiArrowLeftThin" size="24" />
                {{ $t("Previous") }}
            </div>
            <div v-else-if="index === data.links.length - 1">
                {{ $t("Next") }}
                <SvgIcon type="mdi" :path="icons.mdiArrowRightThin" size="24" />
            </div>
            <template v-else>
                {{ label }}
            </template>
        </Link>
    </ul>
    <ul v-show="data.last_page !== 1" class="flex md:hidden">
        <Link
            v-for="({ url }, index) in shortLinks"
            :key="index"
            :class="{
                disabled: !url,
            }"
            :href="url || ''"
            as="li"
            type="button"
            preserve-state
        >
            <div v-if="index === 0">
                <SvgIcon type="mdi" :path="icons.mdiArrowLeftThin" size="24" />
                {{ $t("Previous") }}
            </div>
            <div v-else>
                {{ $t("Next") }}
                <SvgIcon type="mdi" :path="icons.mdiArrowRightThin" size="24" />
            </div>
        </Link>
    </ul>
</template>

<script>
import { Link } from "@inertiajs/vue3";

import SvgIcon from "@jamescoyle/vue-icon";
import { mdiArrowLeftThin, mdiArrowRightThin } from "@mdi/js";

const DOTS = "...";

export default {
    components: { SvgIcon, Link },
    props: {
        data: {
            last_page: {
                type: Number,
                required: true,
            },
            links: {
                type: Array,
                required: true,
            },
        },
    },
    computed: {
        shortLinks() {
            return [this.data.links.at(0), this.data.links.at(-1)];
        },
    },
    setup: () => ({
        DOTS,
        icons: { mdiArrowLeftThin, mdiArrowRightThin },
    }),
};
</script>

<style scoped lang="scss">
ul {
    @apply justify-center gap-0.5;
    li {
        @apply flex items-center justify-center px-2 min-w-[2.75rem] py-2 outline-none border-t-2 transition-all;
        &:first-child,
        &:last-child {
            div {
                @apply flex items-center text-sm gap-1;
            }
        }
        &:first-child {
            @apply mr-auto;
        }
        &:last-child {
            @apply ml-auto;
        }
        &:not(.active) {
            @apply cursor-pointer border-transparent text-stone-500 dark:text-stone-300;
        }
        &.active {
            @apply cursor-not-allowed border-primary-600 text-primary-700 dark:border-primary-400 dark:text-primary-300;
        }
        &.dots {
            @apply cursor-not-allowed text-xl leading-3;
        }
        &.disabled {
            @apply cursor-not-allowed opacity-50;
        }
        &:not(.active, .disabled) {
            @apply hover:border-stone-300 hover:text-stone-800 dark:hover:text-stone-200;
        }
    }
}
</style>
