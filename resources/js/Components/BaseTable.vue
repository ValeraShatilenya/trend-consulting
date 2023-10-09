<template>
    <div>
        <div
            class="hidden md:block border rounded-md bg-white transition-all dark:text-white dark:bg-stone-700 dark:border-stone-500"
        >
            <table class="w-full text-sm bg-transparent">
                <thead>
                    <tr>
                        <th
                            v-for="({ title, centered }, index) in columns"
                            :key="`th_${index}`"
                            class="font-medium py-2 px-3 border-b"
                            :class="centered ? 'text-center' : 'text-left'"
                        >
                            {{ title }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <template v-if="data.meta.total || data.total">
                        <template v-for="item in data.data" :key="item.id">
                            <tr
                                :class="{
                                    'odd:bg-black odd:bg-opacity-[0.02]':
                                        striped,
                                }"
                            >
                                <td
                                    v-for="(column, columnIndex) in columns"
                                    :key="`td_${columnIndex}`"
                                    class="py-2 px-3 border-t"
                                    :class="{ 'text-center': column.centered }"
                                >
                                    <slot
                                        :name="`td-${column.field}`"
                                        :item="item"
                                    >
                                        {{
                                            getValueFromField(
                                                item,
                                                column.field
                                            )
                                        }}
                                    </slot>
                                </td>
                            </tr>
                        </template>
                    </template>
                    <template v-else>
                        <tr>
                            <td :colspan="columns.length">
                                <div
                                    class="flex flex-col items-center justify-center pt-1 pb-4"
                                >
                                    <SvgIcon
                                        type="mdi"
                                        :path="icons.mdiMagnifyMinusOutline"
                                        class="text-black text-opacity-30 dark:text-white dark:text-opacity-60"
                                        size="100"
                                    />
                                    <p
                                        class="text-lg text-black dark:text-white text-opacity-50"
                                    >
                                        {{
                                            $t(
                                                "Sorry, we didn't find anything!"
                                            )
                                        }}
                                    </p>
                                </div>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
            <div v-if="data.meta.total || data.total" class="border-t">
                <Pagination :data="data.meta ? data.meta : data" />
            </div>
        </div>
        <div class="md:hidden">
            <template v-if="data.meta.total || data.total">
                <div
                    v-for="item in data.data"
                    :key="item.id"
                    class="bg-white mb-3 border rounded-md dark:text-white dark:bg-stone-700"
                >
                    <div
                        v-for="(column, columnIndex) in columns"
                        :key="`td_${columnIndex}`"
                        class="flex justify-between gap-3 px-3 py-1 border-b last:border-b-0"
                    >
                        <div class="font-semibold">
                            {{ column.title }}
                        </div>
                        <div>
                            <slot :name="`td-${column.field}`" :item="item">
                                {{ getValueFromField(item, column.field) }}
                            </slot>
                        </div>
                    </div>
                </div>
            </template>
            <div
                v-else
                class="flex flex-col items-center justify-center pt-1 pb-4 bg-white border rounded-md dark:bg-stone-700"
            >
                <SvgIcon
                    type="mdi"
                    :path="icons.mdiMagnifyMinusOutline"
                    class="text-black text-opacity-30 dark:text-white dark:text-opacity-60"
                    size="100"
                />
                <p class="text-lg text-black dark:text-white text-opacity-50">
                    {{ $t("Sorry, we didn't find anything!") }}
                </p>
            </div>
            <div
                v-if="data.meta.total || data.total"
                class="bg-white rounded-md border"
            >
                <Pagination :data="data.meta ? data.meta : data" />
            </div>
        </div>
    </div>
</template>

<script>
import Pagination from "@/Components/Pagination.vue";
import { getValueFromField } from "@/Utils";

import SvgIcon from "@jamescoyle/vue-icon";
import { mdiMagnifyMinusOutline } from "@mdi/js";

export default {
    components: {
        Pagination,
        SvgIcon,
    },
    props: {
        data: {
            type: Object,
            required: true,
        },
        columns: {
            type: Array,
            required: true,
        },
        striped: {
            type: Boolean,
            default: false,
        },
    },
    setup: () => ({
        getValueFromField,
        icons: { mdiMagnifyMinusOutline },
    }),
};
</script>
