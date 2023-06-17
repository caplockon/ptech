<script setup>
import DashboardLayout from "@/components/DashboardLayout.vue";
import IconPlus from "@/components/icons/IconPlus.vue";
import {computed, onMounted, ref, watch} from "vue";
import {useKanban} from "@/services/ptech";
import BasicTable from "@/components/tables/BasicTable.vue";
import {datetime, touchLog, truncate} from "@/utils/filters";
import IconEllipsisVertical from "@/components/icons/IconEllipsisVertical.vue";
import ActionMenu from "@/components/partials/ActionMenu.vue";
import ModalCreateNewProject from "@/modules/kanban/partials/ModalCreateNewProject.vue";
import BlockPlaceholderButton from "@/components/buttons/BlockPlaceholderButton.vue";
import PrimaryButton from "@/components/buttons/PrimaryButton.vue";
import ModalDeleteProject from "@/modules/kanban/partials/ModalDeleteProject.vue";
import IconTrash from "@/components/icons/IconTrash.vue";
import AlternativeButton from "@/components/buttons/AlternativeButton.vue";
import IconPencilSquare from "@/components/icons/IconPencilSquare.vue";

const projects = ref([]);
const deleteProject = ref(null);
const projectTableColumns = ref([
    'Code', 'Name', 'Owner', 'Created At', {label: 'Actions', classes: 'text-right'}
]);
const showToCreateProject = ref(false);

onMounted(() => {
    useKanban().project.fetch().then(results => projects.value = results);
})

function editProject(project) {
    console.log('editProject', project)
}

function projectCreated(project) {
    projects.value.push(project);
    showToCreateProject.value = false;
}

function projectDeleted(project) {
    projects.value = projects.value.filter((p) => p.uuid !== project.uuid);
    deleteProject.value = null;
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

                    <div>
                        <primary-button
                            :icon="IconPlus"
                            @click.prevent="showToCreateProject = true"
                            class="pl-3 flex items-center">Add</primary-button>
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

                                    <primary-button :icon-only="true" :icon="IconPencilSquare"
                                                    size="xs"
                                                    class="mr-1"
                                                    @click="() => {}"/>

                                    <alternative-button :icon-only="true" :icon="IconTrash"
                                                    size="xs"
                                                    @click="() => deleteProject = item"/>
                                </td>
                            </tr>
                        </template>
                    </basic-table>

                    <div class="mt-3" v-if="projects.length === 0">
                        <block-placeholder-button @click.prevent="showToCreateProject = true">
                            <icon-plus class="w-8 h-8 text-gray-600"/>
                        </block-placeholder-button>
                    </div>
                </div>
            </div>
        </div>

        <template v-slot:ending>
            <modal-create-new-project
                @project-created="projectCreated"
                :shown="showToCreateProject"
                @dismiss="showToCreateProject = !showToCreateProject"
                id="createNewProjectModal"/>

            <modal-delete-project
                :shown="!!deleteProject"
                :project="deleteProject"
                @dismiss="deleteProject = null"
                @project-deleted="projectDeleted"
                />
        </template>
    </dashboard-layout>
</template>