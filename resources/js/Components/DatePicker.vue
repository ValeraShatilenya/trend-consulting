<template>
    <VueDatePicker
        v-model="proxyModelValue"
        :model-type="modelType"
        :format="format"
        :clearable="clearable"
        :auto-apply="autoApply"
        class="custom-date-picker"
    />
</template>

<script>
import VueDatePicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";

export default {
    components: {
        VueDatePicker,
    },
    props: {
        modelValue: {
            type: [String, Date, null],
            default: null,
        },
        clearable: {
            type: Boolean,
            default: false,
        },
        modelType: {
            type: String,
            default: "format",
        },
        format: {
            type: String,
            default: "yyyy-MM-dd HH:mm:ss",
        },
        autoApply: {
            type: Boolean,
            default: true,
        },
    },
    emits: ["update:modelValue"],
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

<style lang="scss">
.custom-date-picker {
    .dp__action_select {
        @apply bg-sky-600;
    }
    .dp__input {
        @apply transition-all;
    }
}
.dark {
    .custom-date-picker {
        .dp__input {
            @apply bg-stone-700 text-stone-300;
        }
        .dp__menu,
        .dp__overlay {
            @apply bg-stone-700;
        }
        .dp__pointer.dp__input {
            @apply border-stone-500;
        }
    }
}
</style>
