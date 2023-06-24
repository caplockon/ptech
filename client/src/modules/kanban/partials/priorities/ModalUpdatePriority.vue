<script setup>
import InputText from "@/components/inputs/InputText.vue";
import BaseModal from "@/components/modals/BaseModal.vue";
import PrimaryButton from "@/components/buttons/PrimaryButton.vue";
import {ref, watch} from "vue";
import {validateForm} from "@/modules/kanban/validations/priority";
import {useKanban} from "@/services/ptech";

const props = defineProps({
    priority: {
        type: Object,
        default: null
    }
});

const priority = ref({});
const errors = ref({});

const emit = defineEmits(['priorityUpdated']);

watch(props, () => {
    priority.value = Object.assign({}, props.priority)
})

async function updatePriority() {
    try {
        const validated = await validateForm(priority.value);
        await useKanban().priority.update(priority.value.uuid, validated);
        emit("priorityUpdated", priority.value);
    } catch (e) {
        errors.value = e;
    }
}

</script>
<template>
    <base-modal>
        <template v-slot:header>Edit Priority</template>

        <template v-slot:default>

            <input-text v-model="priority.name"
                        text-label="Name"
                        :error="errors.name"
            />

        </template>

        <template v-slot:footer>
            <primary-button @click="updatePriority">Update</primary-button>
        </template>

    </base-modal>
</template>