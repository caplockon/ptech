<script setup>
import BaseCard from "@/components/cards/BaseCard.vue";
import {ref, watch} from "vue";
import IconBolt from "@/components/icons/IconBolt.vue";
import IconArrowDown from "@/components/icons/IconArrowDown.vue";
import IconArrowUp from "@/components/icons/IconArrowUp.vue";
import IconPencilSquare from "@/components/icons/IconPencilSquare.vue";
import IconTrash from "@/components/icons/IconTrash.vue";
import PrimaryButton from "@/components/buttons/PrimaryButton.vue";
import {useKanban} from "@/services/ptech";
import IconPlus from "@/components/icons/IconPlus.vue";
const props = defineProps({
    project: {
        type: Object,
        default: {}
    },
    statuses: {
        type: Array,
        default: []
    }
});

const statuses = ref([]);

const order = (status1, status2) => status1.priority - status2.priority;

watch(props, () => {
    statuses.value = (props.statuses || [])
        .map(o => Object.assign({}, o))
        .sort(order);
});

function swap(key1, key2) {
    const tempPriority = statuses.value[key1].priority;
    statuses.value[key1].priority = statuses.value[key2].priority;
    statuses.value[key2].priority = tempPriority;

    statuses.value = statuses.value.sort(order);
}

function moveUp(priority, key) {

    if (key === 0) {
        // It's already a top, so that we cannot move up
        return;
    }

    // Moving up means swapping the current item with the previous item
    swap(key, key - 1);
}

function moveDown(priority, key) {

    if (key === statuses.value.length - 1) {
        // It's already a bottom, so that we cannot move down
        return;
    }

    // Moving down means swapping the current item with the next item
    swap(key, key + 1);
}

async function saveStatuses() {
    try {
        await useKanban().project.updateStatuses(props.project.uuid, statuses.value);
    } catch (e) {
        console.log(e);
    }
}
</script>
<template>
    <base-card>

        <div class="flex items-centers justify-between">
            <h3 class="mb-4 text-xl font-semibold dark:text-white">Statuses</h3>

            <div>
                <primary-button size="xs"><icon-plus class="w-4 h-4"/> Add</primary-button>
            </div>
        </div>

        <div class="text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            <div v-for="(status, key) in statuses" :key="status.uuid"
                 class="block w-full px-4 py-2 border-b border-gray-200
                 hover:bg-gray-100 focus:outline-none
                 focus:ring-2 focus:ring-blue-700
                 dark:border-gray-600 dark:hover:bg-gray-600 dark:hover:text-white
                 dark:focus:ring-gray-500 dark:focus:text-white flex items-center justify-between"
                 :class="{'rounded-t-lg': key === 0, 'rounded-b-lg': key === statuses.length - 1}"
            >
                <div class="flex items-center hover:text-blue-700 focus:text-blue-700">
                    <icon-bolt class="w-5 h-5"/>
                    <span class="ml-2">{{status.status}}</span>
                </div>

                <div class="flex items-center gap-2">

                    <button @click="moveUp(status, key)" class="w-5 h-5 hover:bg-gray-300 inline-flex items-center justify-center rounded">
                        <icon-arrow-up class="w-4 h-4"/>
                    </button>

                    <button @click="moveDown(status, key)" class="w-5 h-5 hover:bg-gray-300 inline-flex items-center justify-center rounded">
                        <icon-arrow-down class="w-4 h-4"/>
                    </button>

                    <button class="w-5 h-5 hover:bg-gray-300 inline-flex items-center justify-center rounded">
                        <icon-pencil-square class="w-4 h-4"/>
                    </button>

                    <button class="w-5 h-5 hover:bg-gray-300 inline-flex items-center justify-center rounded">
                        <icon-trash class="w-4 h-4"/>
                    </button>
                </div>
            </div>
        </div>

        <div class="mt-4">
            <primary-button @click="saveStatuses">Save</primary-button>
        </div>
    </base-card>
</template>