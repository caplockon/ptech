<script setup>
import BaseCard from "@/components/cards/BaseCard.vue";
import IconPencilSquare from "@/components/icons/IconPencilSquare.vue";
import IconClock from "@/components/icons/IconClock.vue";
import IconCheck from "@/components/icons/IconCheck.vue";

const props = defineProps({
    task: {
        type: Object,
        default: {}
    }
})
</script>
<template>
    <base-card class="bg-white">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-base font-semibold">{{task.name}}</h3>
            <div>
                <a href="#" @click.prevent="() => {}"
                   class="inline-flex w-8 h-8 items-center justify-center text-gray-600 bg-white
                   rounded-lg hover:bg-gray-100
                   focus:ring-4 focus:ring-primary-300 dark:bg-gray-800
                   dark:text-gray-400 dark:hover:text-white
                   dark:hover:bg-gray-700"
                ><icon-pencil-square class="w-5 h-5"/></a>
            </div>
        </div>

        <div class="text-gray-700 font-medium mb-4" v-html="task.description"></div>

        <div class="flex items-center justify-between">
            <div></div>
            <div>
                <div v-if="task.status === 'Done'" class="flex items-center bg-green-100 px-3 py-1 text-green-700 rounded">
                    <icon-check class="w-5 w-5 mr-2"/>
                    <span class="font-semibold">Done</span>
                </div>
                <div v-else class="flex items-center bg-indigo-100 px-3 py-1 text-indigo-700 rounded">
                    <icon-clock class="w-5 w-5 mr-2"/>
                    <span class="font-semibold">{{task.due_date}}</span>
                </div>
            </div>
        </div>
    </base-card>
</template>