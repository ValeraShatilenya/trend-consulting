<template>
    <div>
        <LocationsFilter
            v-model:search="filter.search"
            v-model:datetime="filter.datetime"
            v-model:warehouses="filter.warehouses"
            :warehouses-list="warehouses"
            :now="now"
        />
        <BaseTable :data="locations" :columns="columns" striped>
            <template #td-product.name="{ item }">
                <div class="flex items-center gap-2 group">
                    <div>
                        {{ item.product.name }}
                    </div>
                    <SvgIcon
                        type="mdi"
                        :path="icons.mdiContentCopy"
                        class="invisible group-hover:visible transition-all cursor-pointer text-black dark:text-white text-opacity-30 hover:text-opacity-60"
                        size="16"
                        @click="copyToClipboard(item.product.name)"
                    />
                </div>
            </template>
            <template #td-color="{ item }">
                <div class="flex items-center gap-2">
                    <div
                        :style="{ background: item.product.color.hex }"
                        class="w-5 h-5 rounded border transition-all hover:scale-110"
                    />
                    <div
                        class="text-xs text-stone-600 transition-all dark:text-stone-400"
                    >
                        ({{ item.product.color.name }})
                    </div>
                </div>
            </template>
        </BaseTable>
    </div>
</template>

<script>
import { router } from "@inertiajs/vue3";
import { debounce } from "lodash-es";
import { getQuery, copyToClipboard } from "@/Utils";
import SvgIcon from "@jamescoyle/vue-icon";
import { mdiContentCopy } from "@mdi/js";

import DefaultLayout from "@/Layouts/DefaultLayout.vue";
import BaseTable from "@/Components/BaseTable.vue";
import LocationsFilter from "./Components/LocationsFilter.vue";

export default {
    components: {
        SvgIcon,
        BaseTable,
        LocationsFilter,
    },
    layout: DefaultLayout,
    props: {
        locations: {
            type: Object,
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
    data() {
        return {
            filter: {
                search: getQuery().search || "",
                datetime: getQuery().datetime || this.now,
                warehouses: [],
            },
            columns: Object.freeze([
                { title: "Product name", field: "product.name" },
                { title: "Warehouse", field: "warehouse.name", centered: true },
                { title: "Type", field: "product.type.name", centered: true },
                { title: "Color", field: "color" },
                { title: "From", field: "period_start_iso", centered: true },
                { title: "To", field: "period_end_iso", centered: true },
            ]),
            icons: Object.freeze({ mdiContentCopy }),
        };
    },
    watch: {
        "filter.search": "debounceUpdateLocations",
        "filter.datetime": "debounceUpdateLocations",
        "filter.warehouses": "debounceUpdateLocations",
    },
    mounted() {
        const warehouses = getQuery().warehouses;
        if (warehouses) {
            this.filter.warehouses = warehouses.map((id) => +id);
        }
    },
    methods: {
        debounceUpdateLocations: debounce(function () {
            this.updateLocations();
        }, 300),
        updateLocations() {
            router.visit(route("locations.index"), {
                data: this.filter,
                preserveState: true,
                only: ["locations"],
            });
        },
        copyToClipboard,
    },
};
</script>
