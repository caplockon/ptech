<script setup>
import DangerAlert from "@/components/alerts/DangerAlert.vue";
import {ref} from "vue";
import PopupModal from "@/components/modals/PopupModal.vue";
import IconExclamationCircle from "@/components/icons/IconExclamationCircle.vue";
import {useKanban} from "@/services/ptech";

const props = defineProps({
    project: {
        type: Object,
        required: false,
        default: {}
    }
});
const error = ref(null);

const emit = defineEmits(['projectDeleted'])

async function deleteProject() {
    try {
        await useKanban().project.detete(props.project.uuid);
        emit('projectDeleted', props.project)
    } catch (e) {
        error.value = e;
    }
}

</script>
<template>
    <popup-modal confirm-scheme="red" @confirm="deleteProject">

        <icon-exclamation-circle class="w-14 h-14 mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200"></icon-exclamation-circle>

        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400"
            v-html="$t('Kanban.ModalDeleteProject.ConfirmMessage', project)"></h3>

        <danger-alert v-if="error">{{error}}</danger-alert>

    </popup-modal>
</template>