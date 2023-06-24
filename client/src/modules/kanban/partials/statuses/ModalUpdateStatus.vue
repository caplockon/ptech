<script setup>
import InputText from "@/components/inputs/InputText.vue";
import BaseModal from "@/components/modals/BaseModal.vue";
import PrimaryButton from "@/components/buttons/PrimaryButton.vue";
import {ref, watch} from "vue";
import {validateForm} from "@/modules/kanban/validations/status";
import {useKanban} from "@/services/ptech";

const props = defineProps({
    status: {
        type: Object,
        default: null
    }
});

const status = ref({});
const errors = ref({});

const emit = defineEmits(['statusUpdated']);

watch(props, () => {
    status.value = Object.assign({}, props.status)
})

async function updateStatus() {
    try {
        const validated = await validateForm(status.value);
        await useKanban().status.update(status.value.uuid, validated);
        emit("statusUpdated", status.value);
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
            <primary-button @click="updateStatus">Update</primary-button>
        </template>

    </base-modal>
</template>