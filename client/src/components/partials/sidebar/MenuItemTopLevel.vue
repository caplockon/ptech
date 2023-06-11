<script setup>
import {computed} from "vue";
import {touchLog} from "@/utils/filters";

const props = defineProps(['label', 'icon', 'link', 'route', 'children']);

const icon = computed(() => props.icon)
const route = computed(() => props.route || props.link)
const children = computed(() => touchLog(props.children || []))
</script>
<template>
    <li>
        <router-link :to="route" active-class="bg-gray-100 dark:bg-gray-700" class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">
            <component v-bind:is="props.icon" class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"></component>
            <span class="ml-3" sidebar-toggle-item>{{props.label}}</span>
        </router-link>

        <div v-for="child in children">{{child.label}}</div>
    </li>
</template>
