<script setup>
import {computed, onMounted, ref} from "vue";
import {touchLog} from "@/utils/filters";
import {useRoute} from "vue-router";
import IconChevronDown from "@/components/icons/IconChevronDown.vue";
import IconChevronUp from "@/components/icons/IconChevronUp.vue";
import IconCog8Tooth from "@/components/icons/IconCog8Tooth.vue";

const props = defineProps(['label', 'icon', 'children']);
const showChildren = ref(false);

const icon = computed(() => props.icon)
const children = computed(() => touchLog(props.children || []))

onMounted(() => {
    const list = props.children || [];
    for (let i = 0; i < list.length; i++) {
        if (list[i].route.name === useRoute().name) {
            showChildren.value = true;
        }
    }
});

</script>
<template>
    <li>
        <button @click="showChildren = !showChildren" type="button" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
            <IconCog8Tooth aria-hidden="true" class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"/>
            <span class="flex-1 ml-3 text-left whitespace-nowrap">{{props.label}}</span>
            <IconChevronDown v-if="!showChildren" class="w-6 h-6"/>
            <IconChevronUp v-if="showChildren" class="w-6 h-6"/>
        </button>
        <ul class="py-2 space-y-2" :class="{'hidden': !showChildren}">
            <li v-for="child in children">
                <router-link active-class="bg-gray-100 dark:bg-gray-700" :to="child.route" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">{{child.label}}</router-link>
            </li>
        </ul>
    </li>
</template>