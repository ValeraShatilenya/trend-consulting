<template>
    <div class="w-full" @click="$refs.search.focus()">
        <label v-if="label" class="text-sm font-medium text-gray-500 pl-1">
            {{ label }}
        </label>
        <div class="relative">
            <input
                ref="search"
                :type="type"
                v-model="proxyModelValue"
                class="peer outline-none w-full rounded-md border py-2 transition-all hover:border-gray-300"
                :class="inputClass"
                v-bind="$attrs"
            />
            <div
                v-if="search"
                class="absolute top-1/2 -translate-y-1/2 left-3 text-stone-400 transition duration-300 peer-focus:rotate-90 peer-focus:text-gray-500"
            >
                <SvgIcon
                    type="mdi"
                    :path="icons.mdiMagnify"
                    size="20"
                    class="will-change-transform"
                />
            </div>
            <button
                v-if="search && proxyModelValue"
                class="absolute top-1/2 -translate-y-1/2 right-3 text-stone-400 transition duration-300 before:content[''] before:absolute before:top-1/2 before:left-1/2 before:block before:h-7 before:w-7 before:-translate-y-1/2 before:-translate-x-1/2 before:rounded-full before:bg-gray-500 before:opacity-0 before:transition-opacity hover:before:opacity-10"
                @click="proxyModelValue = ''"
            >
                <SvgIcon type="mdi" :path="icons.mdiClose" size="20" class="" />
            </button>
        </div>
    </div>
</template>

<script>
import SvgIcon from "@jamescoyle/vue-icon";
import { mdiMagnify, mdiClose } from "@mdi/js";

export default {
    inheritAttrs: false,
    components: {
        SvgIcon,
    },
    props: {
        modelValue: {
            type: [String, Number],
            default: "",
        },
        label: {
            type: String,
            default: "",
        },
        autofocus: {
            type: Boolean,
            default: false,
        },
        search: {
            type: Boolean,
            default: false,
        },
        type: {
            type: String,
            default: "text",
        },
    },
    emits: ["update:modelValue"],
    setup: () => ({
        icons: Object.freeze({
            mdiMagnify,
            mdiClose,
        }),
    }),
    computed: {
        proxyModelValue: {
            get() {
                return this.modelValue;
            },
            set(val) {
                this.$emit("update:modelValue", val);
            },
        },
        inputClass() {
            return this.search ? "pl-9" : "pl-4";
        },
    },
    mounted() {
        this.autofocus && this.$refs.input.focus();
    },
};
</script>
