<script setup>

import IconXMark from "@/components/icons/IconXMark.vue";
import {computed} from "vue";
const props = defineProps({
    closable: {
        type: Boolean,
        default: true
    },
    scheme: {
        type: String,
        default: 'info'
    }
});

const schema = {
    'info':     'text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400',
    'danger':   'text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400',
    'success':  'text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400',
    'warning':  'text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300',
    'dark':     'p-4 text-sm text-gray-800 rounded-lg bg-gray-50 dark:bg-gray-800 dark:text-gray-300',
};

const closableSchema = {
    'info': 'bg-blue-50 text-blue-500 rounded-lg focus:ring-blue-400 hover:bg-blue-200 ' +
        'dark:bg-gray-800 dark:text-blue-400 dark:hover:bg-gray-700',

    'danger': 'bg-red-50 text-red-500 rounded-lg focus:ring-red-400 hover:bg-red-200 ' +
        'dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700',

    'success': 'bg-green-50 text-green-500 focus:ring-green-400 hover:bg-green-200 ' +
        'dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700',

    'warning': 'bg-yellow-50 text-yellow-500 focus:ring-yellow-400 hover:bg-yellow-200 ' +
        'dark:bg-gray-800 dark:text-yellow-300 dark:hover:bg-gray-700',

    'dark': 'bg-gray-50 text-gray-500 focus:ring-gray-400 hover:bg-gray-200 ' +
        'dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white',
};

let alert;

function close() {
    alert && alert.remove();
}

const classes = computed(() => {
    const list = [];
    list.push(schema[props.scheme] ?? schema.info);
    return list.join(' ');
});

const closableClasses = computed(() => {
    const list = [];
    list.push(closableSchema[props.scheme] ?? closableSchema.info);
    return list.join(' ');
})

</script>

<template>
    <div ref="alert" class="flex p-4 mb-4" :class="classes" role="alert">
        <slot></slot>
        <button v-if="props.closable"
            @click="close"
            type="button"
            class="ml-auto -mx-1.5 -my-1.5 p-1.5 h-8 w-8 rounded-lg focus:ring-2 inline-flex"
            aria-label="Close"
            :class="closableClasses">
            <span class="sr-only">Close</span>
            <icon-x-mark aria-hidden="true" class="w-5 h-5"/>
        </button>
    </div>
</template>