<script setup>
import BaseCard from "@/components/cards/BaseCard.vue";
import InputText from "@/components/inputs/InputText.vue";
import InputTextarea from "@/components/inputs/InputTextarea.vue";
import PrimaryButton from "@/components/buttons/PrimaryButton.vue";
import {ref, watch} from "vue";
import {validateForm} from "@/modules/kanban/validations/create_project";
import {useKanban} from "@/services/ptech";

const props = defineProps({
    project: {
        type: Object,
        default: {}
    }
});

const project = ref({});
const errors = ref({});
const emit = defineEmits(['projectUpdated'])

watch(props, () => {
    project.value = Object.assign({}, props.project || {});
});

async function saveProject() {
    try {
        var validated = await validateForm(project.value);
        await useKanban().project.update(project.value.uuid, validated);
        emit('projectUpdated', project.value);
    } catch (e) {
        errors.value = e;
    }
}

</script>
<template>
    <base-card>
        <h3 class="mb-4 text-xl font-semibold dark:text-white">General information</h3>

        <form action="#" @submit.prevent="saveProject">
            <input-text v-model="project.code"
                        text-label="Code"
                        :error="errors.code"
            />

            <input-text v-model="project.name"
                        text-label="Name"
                        :error="errors.name"
            />

            <input-textarea v-model="project.description"
                            text-label="Description"
                            :error="errors.description"
                            rows="8"
            />

            <primary-button type="submit">Save</primary-button>
        </form>
    </base-card>
</template>