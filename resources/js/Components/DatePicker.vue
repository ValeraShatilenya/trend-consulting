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

<style lang="scss" scoped>
.custom-date-picker {
    &::v-deep(.dp__action_select) {
        @apply bg-sky-600;
    }
}
</style>
