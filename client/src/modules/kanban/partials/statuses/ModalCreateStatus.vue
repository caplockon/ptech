<script setup>
import BaseModal from "@/components/modals/BaseModal.vue";
import InputText from "@/components/inputs/InputText.vue";
import PrimaryButton from "@/components/buttons/PrimaryButton.vue";
import {ref} from "vue";
import {validateForm} from "@/modules/kanban/validations/status";
import {useKanban} from "@/services/ptech";

const props = defineProps({
    project: {
        type: Object,
        default: null
    }
});

const status = ref({});
const errors = ref({});

const emit = defineEmits(['statusCreated']);

async function createStatus() {
    try {
        const validated = await validateForm(status.value);
        validated.project_uuid = props.project.uuid;
        const created = await useKanban().status.create(validated);
        emit("statusCreated", created);
    } catch (e) {
        errors.value = e;
    }
}

</script>
<template>
    <base-modal>
        <template v-slot:header>New Status</template>

        <template v-slot:default>

            <input-text v-model="status.status"
                        text-label="Status"
                        :error="errors.status"
            />

        </template>

        <template v-slot:footer>
            <primary-button @click="createStatus">Create</primary-button>
        </template>

    </base-modal>
</template>