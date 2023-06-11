<script setup>
import {computed, ref} from "vue";
import WrappedTable from "@/components/tables/WrappedTable.vue";

const props = defineProps({
    columns: {
        type: Array,
        default: []
    },
    data: {
        type: Array,
        default: []
    }
});

const columns = computed(function () {
    return props.columns.map(function (col, index) {
        if (typeof col === "string") {
            col = {
                label: col,
            }
        }

        col.classes = !!col.classes ? col.classes : "";

        return col;
    });
});

const defaultColumnClasses = ref('p-4 text-sm text-gray-900 whitespace-nowrap dark:text-white');

</script>
<template>
    <wrapped-table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
        <thead class="bg-gray-50 dark:bg-gray-700">
            <tr>
                <th v-for="col in columns" scope="col" class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white" :class="col.classes">
                    {{col.label}}
                </th>
            </tr>
        </thead>

        <tbody>
        <template v-for="row in data">
            <slot :item="row" :classes="defaultColumnClasses"></slot>
        </template>
        </tbody>
    </wrapped-table>
</template>