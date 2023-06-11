<script setup>

import {sizeEnums} from "@/components/inputs/setup";

const props = defineProps({
    modelValue: {
        default: null
    },
    textLabel: String,
    error: {
        type: String,
        default: ''
    },
    disabled: Boolean,
    size: {
        type: String,
        default: 'md',
        validator: (value) => {
            return sizeEnums.includes(value)
        }
    }
});

</script>

<template>

    <button :data-dropdown-toggle="$attrs.id" data-dropdown-placement="bottom" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">Project users <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg></button>

    <!-- Dropdown menu -->
    <div :id="$attrs.id" class="z-10 hidden bg-white rounded-lg shadow w-60 dark:bg-gray-700">
        <ul class="h-48 py-2 overflow-y-auto text-gray-700 dark:text-gray-200">
            <li>
                <a href="#" class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                    Jese Leos
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                    Robert Gough
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                    Bonnie Green
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                    Leslie Livingston
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                    Michael Gough
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                    Joseph Mcfall
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                    Roberta Casas
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                    Neil Sims
                </a>
            </li>
        </ul>
    </div>

</template>