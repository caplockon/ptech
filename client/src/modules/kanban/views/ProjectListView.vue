<script setup>
import DashboardLayout from "@/components/DashboardLayout.vue";
import IconPlus from "@/components/icons/IconPlus.vue";
import {onMounted, ref} from "vue";
import {useKanban} from "@/services/ptech";
import BasicTable from "@/components/tables/BasicTable.vue";
import {datetime, truncate} from "@/utils/filters";
import ModalCreateNewProject from "@/modules/kanban/partials/ModalCreateNewProject.vue";
import BlockPlaceholderButton from "@/components/buttons/BlockPlaceholderButton.vue";
import PrimaryButton from "@/components/buttons/PrimaryButton.vue";
import ModalDeleteProject from "@/modules/kanban/partials/ModalDeleteProject.vue";
import IconTrash from "@/components/icons/IconTrash.vue";
import AlternativeButton from "@/components/buttons/AlternativeButton.vue";
import IconPencilSquare from "@/components/icons/IconPencilSquare.vue";
import ModalEditProject from "@/modules/kanban/partials/ModalEditProject.vue";

const projects = ref([]);
const deleteProject = ref(null);
const projectToBeUpdated = ref(null);
const projectTableColumns = ref([
    'Code', 'Name', 'Owner', 'Created At', {label: 'Actions', classes: 'text-right'}
]);
const showToCreateProject = ref(false);

onMounted(() => {
    useKanban().project.fetch().then(results => projects.value = results);
})

function projectCreated(project) {
    projects.value.push(project);
    showToCreateProject.value = false;
}

function projectDeleted(project) {
    projects.value = projects.value.filter((p) => p.uuid !== project.uuid);
    deleteProject.value = null;
}

function onProjectUpdated(updatedProject) {
    var pos = projects.value.findIndex((p) => p.uuid === updatedProject.uuid);
    if (pos >= 0) {
        projects.value[pos] = updatedProject;
    }
    projectToBeUpdated.value = null;
}
</script>

<template>
    <dashboard-layout>
        <div class="flex flex-col">
            <div class="bg-white border border-gray-200 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                <!-- Card header -->
                <div class="items-center justify-between lg:flex sm:p-4">
                    <div class="mb-4 lg:mb-0">
                        <h3 class="mb-2 text-xl font-bold text-gray-900 dark:text-white">{{$t('Kanban.ProjectListCardTitle')}}</h3>
                        <span class="text-base font-normal text-gray-500 dark:text-gray-400">
                            {{projects.length === 0 ? $t('Kanban.ProjectListEmptyDesc') : $t('Kanban.ProjectListDesc')}}
                        </span>
                    </div>
                </div>

                <div class="items-center px-4 justify-between block sm:flex md:divide-x md:divide-gray-100 dark:divide-gray-700">
                    <div class="flex items-center mb-4 sm:mb-0">
                        <form class="sm:pr-3" action="#" method="GET">
                            <label for="products-search" class="sr-only">Search</label>
                            <div class="relative w-48 mt-1 sm:w-64 xl:w-96">
                                <input type="text" name="email" id="products-search" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Search for products">
                            </div>
                        </form>
                        <div class="flex items-center w-full sm:justify-end">
                            <div class="flex pl-2 space-x-1">
                                <a href="#" class="inline-flex justify-center p-1 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"></path></svg>
                                </a>
                                <a href="#" class="inline-flex justify-center p-1 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                                </a>
                                <a href="#" class="inline-flex justify-center p-1 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                                </a>
                                <a href="#" class="inline-flex justify-center p-1 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"></path></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    <primary-button
                        :icon="IconPlus"
                        @click.prevent="showToCreateProject = true"
                        class="pl-3 flex items-center">Add</primary-button>
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

                                    <primary-button :icon="IconPencilSquare"
                                                    size="xs"
                                                    class="mr-1"
                                                    @click="() => projectToBeUpdated = item"
                                    >Edit</primary-button>

                                    <alternative-button :icon="IconTrash"
                                                    size="xs"
                                                        @click="() => deleteProject = item"
                                    >Delete</alternative-button>
                                </td>
                            </tr>
                        </template>
                    </basic-table>

                    <div class="mt-3" v-if="projects.length === 0">
                        <block-placeholder-button @click.prevent="showToCreateProject = true">
                            <icon-plus class="w-8 h-8 text-gray-600"/>
                        </block-placeholder-button>
                    </div>

                    <div class="sticky bottom-0 right-0 items-center w-full p-4 bg-white border-t border-gray-200 sm:flex sm:justify-between dark:bg-gray-800 dark:border-gray-700">
                        <div class="flex items-center mb-4 sm:mb-0">
                            <a href="#" class="inline-flex justify-center p-1 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">
                                <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                            </a>
                            <a href="#" class="inline-flex justify-center p-1 mr-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">
                                <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            </a>
                            <span class="text-sm font-normal text-gray-500 dark:text-gray-400">Showing <span class="font-semibold text-gray-900 dark:text-white">1-20</span> of <span class="font-semibold text-gray-900 dark:text-white">2290</span></span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <a href="#" class="inline-flex items-center justify-center flex-1 px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                <svg class="w-5 h-5 mr-1 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                                Previous
                            </a>
                            <a href="#" class="inline-flex items-center justify-center flex-1 px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                Next
                                <svg class="w-5 h-5 ml-1 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <template v-slot:ending>
            <modal-create-new-project
                @project-created="projectCreated"
                :shown="showToCreateProject"
                @dismiss="showToCreateProject = !showToCreateProject"
                id="createNewProjectModal"
            />

            <modal-delete-project
                :shown="!!deleteProject"
                :project="deleteProject"
                @dismiss="deleteProject = null"
                @project-deleted="projectDeleted"
            />

            <modal-edit-project
                :shown="!!projectToBeUpdated"
                :project="projectToBeUpdated"
                @dismiss="projectToBeUpdated = null"
                @project-updated="onProjectUpdated"
            />
        </template>
    </dashboard-layout>
</template>