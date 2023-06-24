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
import ModalCreateStatus from "@/modules/kanban/partials/statuses/ModalCreateStatus.vue";
import PopupModal from "@/components/modals/PopupModal.vue";
import IconExclamationCircle from "@/components/icons/IconExclamationCircle.vue";
import ModalDeleteStatus from "@/modules/kanban/partials/statuses/ModalDeleteStatus.vue";
import ModalUpdateStatus from "@/modules/kanban/partials/statuses/ModalUpdateStatus.vue";

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

const creatingNewStatus = ref(false);
function onStatusCreated(created) {
    creatingNewStatus.value = false;
    project.value.statuses.push(created);
    toast.pushSuccess(`New status '${created.status}' was created successfully`);
}

const statusToBeDeleted = ref(null);
function onStatusDeleted(deleted) {
    statusToBeDeleted.value = null;
    project.value.statuses = project.value.statuses.filter(o => o.uuid !== deleted.uuid)
    toast.pushSuccess(`Status '${deleted.status}' was deleted successfully`);
}


const statusToBeUpdated = ref(null);
function onStatusUpdated(updated) {
    statusToBeUpdated.value = null;
    const pos = project.value.statuses.findIndex(o => o.uuid === updated.uuid);
    if (pos >= 0) {
        Object.assign(project.value.statuses[pos], updated);
    }

    toast.pushSuccess(`Status '${updated.status}' has been updated successfully`);
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
                    @create-status="creatingNewStatus = true"
                    @delete-status="(o) => statusToBeDeleted = o"
                    @edit-status="(o) => statusToBeUpdated = o"
                />

                <project-priority-list
                    :project="project"
                    :priorities="project.priorities ?? []"
                />

            </div>
        </div>

        <template v-slot:ending>
            <modal-create-status
                :shown="creatingNewStatus"
                :project="project"
                @dismiss="creatingNewStatus = false"
                @status-created="onStatusCreated"
            />

            <modal-delete-status
                :shown="!!statusToBeDeleted"
                :status="statusToBeDeleted"
                @dismiss="statusToBeDeleted = null"
                @status-deleted="onStatusDeleted"
            />

            <modal-update-status
                :shown="!!statusToBeUpdated"
                :status="statusToBeUpdated"
                @dismiss="statusToBeUpdated = null"
                @status-updated="onStatusUpdated"
            />
        </template>
    </dashboard-layout>
</template>