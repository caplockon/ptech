<script setup>
import TaskCard from "@/modules/kanban/partials/TaskCard.vue";
import IconPlus from "@/components/icons/IconPlus.vue";
import {defineComponent, onMounted, ref} from "vue";
import draggable from 'vuedraggable'

const props = defineProps({
    name: {
        type: String,
        required: true
    },
    tasks: {
        type: Array,
        default: []
    }
});

const tasks = ref(props.tasks);

onMounted(() => {console.log(tasks.value = props.tasks)})
defineComponent(draggable)

</script>

<template>
    <div class="mb-8">
        <h3 class="text-base font-semibold text-gray-600 mb-5">{{props.name}}</h3>
        <div>
            <draggable
                v-model="tasks"
                item-key="uuid">
                <template #item="{element}">
                    <task-card class="task-card" :task="element"/>
                </template>
            </draggable>
        </div>

        <div>
            <button type="button" class="flex items-center rounded-lg justify-center px-2 py-4 w-full border-2 border-gray-200 text-gray-500 border-dashed bg-gray-100">
                <icon-plus class="w-6 w-6"/>
            </button>
        </div>
    </div>
</template>

<style>
.task-card[draggable="true"] {
    opacity: .5;
    transform: translateZ(100px) !important;
}
</style>