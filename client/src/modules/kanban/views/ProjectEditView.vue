<script setup>
import DashboardLayout from "@/components/DashboardLayout.vue";
import {useRoute} from "vue-router";
import {onMounted, ref} from "vue";
import {useKanban} from "@/services/ptech";
import PageTitle from "@/components/partials/PageTitle.vue";
import ProjectGeneralInformation from "@/modules/kanban/partials/ProjectGeneralInformation.vue";
import ProjectStatusList from "@/modules/kanban/partials/ProjectStatusList.vue";
import ProjectPriorityList from "@/modules/kanban/partials/ProjectPriorityList.vue";
import {useToast} from "@/stores/toast";

const route = useRoute();
const project = ref({});
const toast = useToast();

onMounted(() => {
    useKanban().project.get(route.params.uuid).then(data => project.value = data);
});

function onProjectUpdated(updated) {
    Object.assign(project, updated)
    toast.pushSuccess("Project has been updated successfully")
}

</script>
<template>
    <dashboard-layout>
        <div class="grid grid-cols-1 px-4 pt-6 xl:grid-cols-3 xl:gap-4 dark:bg-gray-900">
            <div class="mb-4 col-span-full xl:mb-2">
                <page-title>Project <span class="font-semibold">{{project.code}} - {{project.name}}</span></page-title>
            </div>

            <div class="col-span-full xl:col-auto">

                <project-general-information
                    :project="project"
                    @project-updated="onProjectUpdated"
                />

            </div>

            <div class="col-span-2">
                <project-status-list
                    :project="project"
                    :statuses="project.statuses ?? []"
                />

                <project-priority-list
                    :project="project"
                    :priorities="project.priorities ?? []"
                />

            </div>
        </div>

    </dashboard-layout>
</template>