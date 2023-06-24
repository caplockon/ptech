<script setup>
import DashboardLayout from "@/components/DashboardLayout.vue";
import TaskGroup from "@/modules/kanban/partials/TaskGroup.vue";
import {computed, defineComponent, onMounted, ref} from "vue";
import draggable from "vuedraggable";
import {useKanban} from "@/services/ptech";
import {useRoute} from "vue-router";

const tasks = ref([]);
const kanban = useKanban();
const route = useRoute();

const project = ref({});

onMounted(() => {

    kanban.project.board(route.params.code).then(res => project.value = res);

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

const statusGroups = computed(() => {
    return project.value.statuses || [];
});

const taskGroups = computed(() => {
    const result = [];

    for (let i = 0; i < project.value.tasks.length; i++) {
        let task = project.value.tasks[i];
        let groupId = task.status.uuid ?? null;

        if (! groupId) {
            continue;
        }


        let pos = result.findIndex(g => g.id === groupId)

        if (pos >= 0) {
            result[pos].tasks.push(task);
        } else {
            result.push({id: groupId, tasks: [task]});
        }
    }

    return result;
});

function getTaskInGroup(taskGroups, groupId) {
    let pos = taskGroups.findIndex(g => g.id === groupId)
    return pos >= 0 ? taskGroups[pos].tasks : [];
}

defineComponent(draggable)
</script>
<template>
    <dashboard-layout>
        <draggable v-model="statusGroups" class="grid grid-cols-1 px-4 pt-6 xl:grid-cols-3 xl:gap-4 dark:bg-gray-900">
            <template #item="{element}">
                <task-group class="col-span-1" :name="element.status" :tasks="getTaskInGroup(taskGroups, element.uuid)"/>
            </template>
        </draggable>
    </dashboard-layout>
</template>
