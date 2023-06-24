
<script setup>
import BaseModal from "@/components/modals/BaseModal.vue";
import InputText from "@/components/inputs/InputText.vue";
import PrimaryButton from "@/components/buttons/PrimaryButton.vue";
import {ref} from "vue";
import {validateForm} from "@/modules/kanban/validations/priority";
import {useKanban} from "@/services/ptech";

const props = defineProps({
    project: {
        type: Object,
        default: null
    }
});

const priority = ref({});
const errors = ref({});

const emit = defineEmits(['priorityCreated']);

async function createPriority() {
    try {
        const validated = await validateForm(priority.value);
        validated.project_uuid = props.project.uuid;
        console.log(validated)
        const created = await useKanban().priority.create(validated);
        emit("priorityCreated", created);
        priority.value = {};
    } catch (e) {
        errors.value = e;
    }
}

</script>
<template>
    <base-modal>
        <template v-slot:header>New Priority</template>

        <template v-slot:default>

            <input-text v-model="priority.name"
                        text-label="Name"
                        :error="errors.name"
            />

        </template>

        <template v-slot:footer>
            <primary-button @click="createPriority">Create</primary-button>
        </template>

    </base-modal>
</template>