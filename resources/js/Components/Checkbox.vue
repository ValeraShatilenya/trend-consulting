<template>
    <div class="flex items-center gap-2">
        <div
            class="relative flex cursor-pointer items-center rounded-full h-5 w-5"
        >
            <input
                v-model="proxyModelValue"
                :true-value="true"
                :false-value="false"
                type="checkbox"
                class="relative w-full h-full cursor-pointer appearance-none rounded-md border border-solid transition-all before:absolute before:content[''] before:top-1/2 before:left-1/2 before:block before:h-9 before:w-9 before:-translate-y-1/2 before:-translate-x-1/2 before:rounded-full before:bg-gray-500 before:opacity-0 before:transition-opacity hover:before:opacity-10 border-gray-300 checked:border-primary-500 checked:bg-primary-500 checked:before:bg-primary-500"
            />
            <div
                class="pointer-events-none absolute top-1/2 left-1/2 -translate-y-1/2 -translate-x-1/2 text-white transition-all"
                :class="proxyModelValue ? 'opacity-100' : 'opacity-0'"
            >
                <SvgIcon type="mdi" :path="icons.mdiCheck" size="16" />
            </div>
        </div>
        <label
            @click="proxyModelValue = !proxyModelValue"
            class="cursor-pointer dark:text-stone-400"
            >{{ label }}</label
        >
    </div>
</template>

<script>
import SvgIcon from "@jamescoyle/vue-icon";
import { mdiCheck } from "@mdi/js";

export default {
    components: { SvgIcon },
    props: {
        modelValue: {
            type: Boolean,
            required: true,
        },
        label: {
            type: String,
            default: "",
        },
    },
    emits: ["update:modelValue"],
    data: () => ({ icons: Object.freeze({ mdiCheck }) }),
    computed: {
        proxyModelValue: {
            get() {
                return this.modelValue;
            },

            set(val) {
                this.$emit("update:modelValue", val);
            },
        },
    },
};
</script>
