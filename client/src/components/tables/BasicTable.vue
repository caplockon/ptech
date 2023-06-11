<script setup>
import {computed} from "vue";

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
            return {
                label: col
            }
        }

        return col;
    });
})

</script>
<template>
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th v-for="col in columns" scope="col" class="px-6 py-3 w-16">{{col.label}}</th>
        </tr>
        </thead>

        <tbody>
        <template v-for="row in data">
            <slot :item="row"></slot>
        </template>
        </tbody>
    </table>
</template>