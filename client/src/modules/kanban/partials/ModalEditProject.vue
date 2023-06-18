<script setup>
import BaseModal from "@/components/modals/BaseModal.vue";
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

watch(props, () => {
    project.value = props.project ? Object.assign({}, props.project) : {};
})

const emit = defineEmits(['projectUpdated']);

async function updateProject() {
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
    <base-modal>

        <template v-slot:header>{{ $t('Kanban.ModalEditProject.ModalTitle', project) }}</template>

        <template v-slot:default>

            <input-text v-model="project.code"
                        :error="errors.code"
                        :text-label="$t('Kanban.ModalEditProject.CodeLabel')"
                        @focus="errors.code = null"/>

            <input-text v-model="project.name"
                        :error="errors.name"
                        :text-label="$t('Kanban.ModalEditProject.NameLabel')"
                        @focus="errors.name = null"/>

            <input-textarea v-model="project.description"
                            :error="errors.description"
                            :text-label="$t('Kanban.ModalEditProject.DescLabel')"
                            @focus="errors.description = null"
                            rows="4"/>

        </template>

        <template v-slot:footer>
            <primary-button @click="updateProject">{{ $t('Kanban.ModalEditProject.EditButtonLabel') }}</primary-button>
        </template>

    </base-modal>
</template>