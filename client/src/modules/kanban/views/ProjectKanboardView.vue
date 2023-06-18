<script setup>
import DashboardLayout from "@/components/DashboardLayout.vue";
import TaskGroup from "@/modules/kanban/partials/TaskGroup.vue";
import {computed, defineComponent, onMounted, ref} from "vue";
import draggable from "vuedraggable";

const tasks = ref([]);

onMounted(() => {
    tasks.value = [
        {
            uuid: '1',
            name: 'Change Events Javascript',
            description: 'In _variables.scss on line 672 you define $table_variants. Each instance of "color-level" needs to be changed to "shift-color".',
            status: 'To Do',
            due_date: '5 days left'
        },
        {
            uuid: '2',
            name: 'Until recently, the prevailing',
            description: 'Unt;il recently, the prevailing view assumed lorem ipsum was born as a nonsense text. “It\'s not Latin, though it looks like it, and it actually says nothing,”',
            status: 'Done',
            due_date: '5 days left'
        },
        {
            uuid: '3',
            name: 'As Cicero would put it',
            description: 'The placeholder text, beginning with the line “Lorem ipsum dolor sit amet, consectetur adipiscing elit”, looks like Latin because in its youth, centuries ago, it was Latin.',
            status: 'Done',
            due_date: '5 days left'
        },
        {
            uuid: '4',
            name: 'Change Events Javascript',
            description: 'In _variables.scss on line 672 you define $table_variants. Each instance of "color-level" needs to be changed to "shift-color".',
            status: 'In Progress',
            due_date: '5 days left'
        },
        {
            uuid: '5',
            name: 'Change Events Javascript',
            description: 'In _variables.scss on line 672 you define $table_variants. Each instance of "color-level" needs to be changed to "shift-color".',
            status: 'Done',
            due_date: '5 days left'
        },
        {
            uuid: '6',
            name: 'Change Events Javascript',
            description: 'In _variables.scss on line 672 you define $table_variants. Each instance of "color-level" needs to be changed to "shift-color".',
            status: 'In Progress',
            due_date: '5 days left'
        },
        {
            uuid: '7',
            name: 'Whether a medieval',
            description: 'or whether a quirk in the 1914 Loeb Edition inspired a graphic designer, it\'s admittedly an odd way for Cicero to sail into the 21st century.',
            status: 'To Do',
            due_date: '5 days left'
        },
        {
            uuid: '8',
            name: 'Change Events Javascript',
            description: 'In _variables.scss on line 672 you define $table_variants. Each instance of "color-level" needs to be changed to "shift-color".',
            status: 'In Progress',
            due_date: '5 days left'
        }
    ]
});

const groups = computed(() => {

    const groupPriorities = {
        'To DO': 1,
        'In Progress': 2,
        'Done': 3,
    };

    const results = [];
    const positions = {};

    for (let i = 0; i < tasks.value.length; i++) {
        let task = tasks.value[i];
        let pos;

        if (!positions.hasOwnProperty(task.status)) {
            results.push({
                tasks: [],
                name: task.status
            });
            positions[task.status] = pos = results.length - 1;
        } else {
            pos = positions[task.status];
        }

        results[pos].tasks.push(task);
    }

    results.sort((a, b) => {
        return groupPriorities[a.name] - groupPriorities[b.name];
    });

    return results;
});

defineComponent(draggable)
</script>
<template>
    <dashboard-layout>
        <draggable v-model="groups" class="grid grid-cols-1 px-4 pt-6 xl:grid-cols-3 xl:gap-4 dark:bg-gray-900">
            <template #item="{element}">
                <task-group class="col-span-1" :name="element.name" :tasks="element.tasks"/>
            </template>
        </draggable>
    </dashboard-layout>
</template>
