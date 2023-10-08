<template>
    <div class="flex gap-3 mb-3">
        <TextInput
            :modelValue="search"
            @update:modelValue="updateSearch"
            search
            placeholder="Enter the product name"
        />
        <button
            class="border bg-white w-10 h-10 rounded-md flex justify-center items-center transition-all dark:bg-stone-600 dark:border-stone-500 dark:text-stone-300"
            @click="showFilter = !showFilter"
        >
            <SvgIcon type="mdi" :path="icons.mdiFilterVariant" />
        </button>
    </div>
    <div
        class="transition-all grid"
        :class="{
            'opacity-100 grid-rows-[1fr] mb-3': showFilter,
            'opacity-0 grid-rows-[0fr]': !showFilter,
        }"
    >
        <div
            class="min-h-0 transition-all grid grid-cols-1 sm:grid-cols-[1fr_1fr_auto] gap-3"
            :class="{ 'overflow-hidden': !showFilter }"
        >
            <DatePicker
                :modelValue="datetime"
                @update:modelValue="updateDatetime"
            />
            <CheckboxesDropdown
                :modelValue="warehouses"
                :data="warehousesList"
                label-field="name"
                value-field="id"
                placeholder="Select warehouses"
                @update:modelValue="updateWarehouses"
            />
            <button
                class="bg-primary-500 text-white px-3 h-10 rounded-md flex items-center justify-center gap-2 dark:bg-primary-800 dark:text-black"
                @click="clearFilter"
            >
                <SvgIcon type="mdi" :path="icons.mdiVacuum" />
                Clear filter
            </button>
        </div>
    </div>
</template>

<script>
import SvgIcon from "@jamescoyle/vue-icon";
import { mdiFilterVariant, mdiVacuum } from "@mdi/js";

import TextInput from "@/Components/TextInput.vue";
import DatePicker from "@/Components/DatePicker.vue";
import CheckboxesDropdown from "@/Components/CheckboxesDropdown.vue";

export default {
    components: {
        SvgIcon,
        TextInput,
        DatePicker,
        CheckboxesDropdown,
    },
    props: {
        warehousesList: {
            type: Array,
            required: true,
        },
        search: {
            type: String,
            required: true,
        },
        datetime: {
            type: String,
            required: true,
        },
        warehouses: {
            type: Array,
            required: true,
        },
        now: {
            type: String,
            required: true,
        },
    },
    emits: ["update:search", "update:datetime", "update:warehouses"],
    data: () => ({
        icons: Object.freeze({ mdiFilterVariant, mdiVacuum }),
        showFilter: false,
    }),
    methods: {
        updateSearch(value) {
            this.$emit("update:search", value);
        },
        updateDatetime(value) {
            this.$emit("update:datetime", value);
        },
        updateWarehouses(value) {
            this.$emit("update:warehouses", value);
        },
        clearFilter() {
            this.updateSearch("");
            this.updateWarehouses([]);
            this.updateDatetime(this.now);
        },
    },
};
</script>
