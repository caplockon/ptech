<script setup>
import IconExclamationCircle from "@/components/icons/IconExclamationCircle.vue";
import PopupModal from "@/components/modals/PopupModal.vue";
import DangerAlert from "@/components/alerts/DangerAlert.vue";
import {ref} from "vue";
import {useKanban} from "@/services/ptech";

const error = ref(null);
const props = defineProps({
    priority: {
        type: Object,
        default: {}
    }
});

const emit = defineEmits(['priorityDeleted'])

async function deletePriority() {
    try {
        await useKanban().priority.delete(props.priority.uuid);
        emit("priorityDeleted", props.priority);
    } catch (e) {
        error.value = e;
    }
}

</script>
<template>
    <popup-modal confirm-scheme="red" @confirm="deletePriority">
        <icon-exclamation-circle class="w-14 h-14 mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200"></icon-exclamation-circle>

        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Do you want to delete this priority?</h3>

        <danger-alert v-if="error">{{error}}</danger-alert>
    </popup-modal>
</template>