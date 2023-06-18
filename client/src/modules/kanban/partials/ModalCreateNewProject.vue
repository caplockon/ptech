<script setup>
import InputText from "@/components/inputs/InputText.vue";
import InputTextarea from "@/components/inputs/InputTextarea.vue";
import BaseModal from "@/components/modals/BaseModal.vue";
import PrimaryButton from "@/components/buttons/PrimaryButton.vue";
import {ref, unref} from "vue";
import {validateForm} from "@/modules/kanban/validations/create_project";
import {useKanban} from "@/services/ptech";

const project = ref({});
const errors = ref({});

const emit = defineEmits(['projectCreated']);

async function createProject() {
    try {
        const validated = await validateForm(unref(project));
        project.value = await useKanban().project.create(validated);
        emit("projectCreated", project.value);
        project.value = {};
    }
    catch (e) {
        errors.value = e;
    }
}

</script>

<template>
    <base-modal>

        <template v-slot:header>{{ $t('Kanban.ModalCreateProject.ModalTitle') }}</template>

        <template v-slot:default>

            <input-text v-model="project.code"
                :error="errors.code"
                :text-label="$t('Kanban.ModalCreateProject.CodeLabel')"
                @focus="errors.code = null"/>

            <input-text v-model="project.name"
                :error="errors.name"
                :text-label="$t('Kanban.ModalCreateProject.NameLabel')"
                @focus="errors.name = null"/>

            <input-textarea v-model="project.description"
                :error="errors.description"
                :text-label="$t('Kanban.ModalCreateProject.DescLabel')"
                @focus="errors.description = null"
                rows="4"/>

        </template>

        <template v-slot:footer>
            <primary-button @click="createProject">{{ $t('Kanban.ModalCreateProject.CreateButtonLabel') }}</primary-button>
        </template>

    </base-modal>
</template>