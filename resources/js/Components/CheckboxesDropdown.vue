<template>
    <div ref="root" class="search-dropdown relative">
        <button
            :class="open ? 'border-gray-400' : 'border-gray-200'"
            class="rounded-md h-10 border w-full bg-white pl-4"
            @click="onClickTrigger"
        >
            <div class="grid gap-1 grid-cols-[1fr_auto]">
                <div
                    class="truncate text-left"
                    :class="{
                        'text-gray-400': !open && !modelValue.length,
                    }"
                >
                    {{ textTrigger }}
                </div>
                <div class="mr-2 shrink-0">
                    <SvgIcon
                        type="mdi"
                        :path="icons.mdiChevronUp"
                        class="shrink-0 transition-all duration-300 ease-in-out cursor-pointer"
                        :rotate="!open ? 180 : 0"
                    />
                </div>
            </div>
        </button>

        <Transition
            enter-active-class="transition ease-out duration-200"
            enter-from-class="transform opacity-0 scale-95"
            enter-to-class="transform opacity-100 scale-100"
            leave-active-class="transition ease-in duration-75"
            leave-from-class="transform opacity-100 scale-100"
            leave-to-class="transform opacity-0 scale-95"
        >
            <div
                v-show="open"
                class="mt-2 rounded-md shadow-lg w-full origin-top-left left-0 overflow-y-auto max-h-56 sm:absolute sm:z-50"
            >
                <div
                    class="rounded-md ring-1 ring-black ring-opacity-5 py-2 bg-white"
                >
                    <div @click.stop>
                        <div
                            v-for="(item, index) in data"
                            :key="index"
                            class="py-2 px-5 cursor-pointer transition-all hover:bg-primary-50"
                            @click.stop="onToggleItem(item)"
                        >
                            <Checkbox
                                :modelValue="
                                    modelValue.includes(
                                        valueField
                                            ? getValueFromField(
                                                  item,
                                                  valueField
                                              )
                                            : item
                                    )
                                "
                                :label="
                                    labelField
                                        ? getValueFromField(item, labelField)
                                        : item
                                "
                            />
                        </div>
                    </div>
                </div>
            </div>
        </Transition>
    </div>
</template>

<script>
import Checkbox from "@/Components/Checkbox.vue";
import SvgIcon from "@jamescoyle/vue-icon";
import { mdiChevronUp } from "@mdi/js";
import { getValueFromField } from "@/Utils";

export default {
    name: "SearchDropdown",
    components: {
        Checkbox,
        SvgIcon,
    },
    props: {
        modelValue: {
            type: Array,
            required: true,
        },
        data: {
            type: Array,
            required: true,
        },
        placeholder: {
            type: String,
            required: true,
        },
        labelField: {
            type: [String, null],
            default: null,
        },
        valueField: {
            type: [String, null],
            default: null,
        },
        notFound: {
            type: String,
            default: "Not Found!",
        },
    },
    emits: ["update:modelValue"],
    data: () => ({
        open: false,
        showDropdown: true,
        icons: Object.freeze({
            mdiChevronUp,
        }),
    }),
    computed: {
        textTrigger() {
            return !this.modelValue.length
                ? this.placeholder
                : `${this.modelValue.length} selected`;
        },
    },
    methods: {
        closeOnEscape(e) {
            if (this.open && e.key === "Escape") {
                this.open = false;
            }
        },
        isDescendant(parent, child) {
            let node = child.parentNode;
            while (node !== null) {
                if (node === parent) {
                    return true;
                }
                node = node.parentNode;
            }

            return false;
        },
        onMouseClick(e) {
            if (this.open && !this.isDescendant(this.$refs.root, e.target)) {
                this.open = false;
            }
        },
        onToggleItem(item) {
            const modelValue = [...this.modelValue];
            const searchItem = this.valueField
                ? getValueFromField(item, this.valueField)
                : item;
            const index = modelValue.indexOf(searchItem);
            if (index > -1) {
                modelValue.splice(index, 1);
            } else {
                modelValue.push(searchItem);
            }
            this.$emit("update:modelValue", modelValue);
        },
        onClickTrigger() {
            this.open = !this.open;
        },
        getValueFromField,
    },
    mounted() {
        window.addEventListener("keydown", this.closeOnEscape);
        window.addEventListener("mousedown", this.onMouseClick);
    },
    unmounted() {
        window.removeEventListener("keydown", this.closeOnEscape);
        window.addEventListener("mousedown", this.onMouseClick);
    },
};
</script>

<style scoped lang="scss">
.search-dropdown {
    ::-webkit-scrollbar {
        width: 6px;
        &-track {
            border-radius: 3px;
            background-color: rgba(0, 0, 0, 0.2);
        }
        &-thumb {
            border-radius: 3px;
            background-color: rgba(0, 0, 0, 0.2);
        }
    }
}
</style>
