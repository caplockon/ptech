<script setup>
import DashboardLayout from "@/components/DashboardLayout.vue";
import IconPlus from "@/components/icons/IconPlus.vue";
import {onMounted, onUpdated, ref} from "vue";
import {useKanban} from "@/services/ptech";
import BasicTable from "@/components/tables/BasicTable.vue";
import {datetime, truncate} from "@/utils/filters";
import IconEllipsisVertical from "@/components/icons/IconEllipsisVertical.vue";
import {initDropdowns} from "flowbite";
import ActionMenu from "@/components/partials/ActionMenu.vue";

const projects = ref([]);
const projectTableColumns = ref([
    'Code', 'Name', 'Owner', 'Created At', {label: 'Actions', classes: 'text-right'}
]);

onMounted(() => {
    useKanban().project.fetch().then(results => projects.value = results).then(() => initDropdowns());
})

function editProject(project) {
    console.log('editProject', project)
}

function deleteProject(project) {
    console.log('deleteProject', project)
}
</script>

<template>
    <dashboard-layout>
        <div class="px-4 pt-6">
            <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                <!-- Card header -->
                <div class="items-center justify-between lg:flex">
                    <div class="mb-4 lg:mb-0">
                        <h3 class="mb-2 text-xl font-bold text-gray-900 dark:text-white">{{$t('Kanban.ProjectListCardTitle')}}</h3>
                        <span class="text-base font-normal text-gray-500 dark:text-gray-400">
                            {{projects.length === 0 ? $t('Kanban.ProjectListEmptyDesc') : $t('Kanban.ProjectListDesc')}}
                        </span>
                    </div>
                </div>

                <!-- Card body -->
                <div class="flex flex-col mt-6 min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                    <basic-table :columns="projectTableColumns" :data="projects">
                        <template v-slot="{item, classes}">
                            <tr>
                                <td :class="classes" class="font-bold">
                                    {{item.code}}
                                </td>
                                <td :class="classes">
                                    {{item.name}}<br>
                                    <span class="text-gray-400">{{truncate(item.description, 50)}}</span>
                                </td>
                                <td :class="classes">
                                    You
                                </td>
                                <td :class="classes">
                                    {{datetime(item.created_at, 'll')}}
                                </td>
                                <td class="p-4 whitespace-nowrap text-right">
                                    <button type="button" :data-dropdown-toggle="'projectAction' + item.uuid">
                                        <icon-ellipsis-vertical class="w-4 h-4"/>
                                    </button>

                                    <div :id="'projectAction' + item.uuid" class="z-10 text-left hidden bg-white divide-y divide-gray-100 rounded-lg shadow-lg border w-44 dark:bg-gray-700">
                                        <action-menu :item="item" @edit="editProject" @delete="deleteProject"/>
                                    </div>
                                </td>
                            </tr>
                        </template>
                    </basic-table>

                    <button class="flex w-full transition border-2 rounded border-dashed bg-gray-100 px-4 py-8 justify-center hover:bg-gray-200 hover:border-gray-300">
                        <icon-plus class="w-8 h-8 text-gray-600"/>
                    </button>
                </div>
            </div>
        </div>
    </dashboard-layout>
</template>