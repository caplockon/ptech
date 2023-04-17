<script setup>

import ModalContent from "@/components/modals/ModalContent.vue";
import InputText from "@/components/inputs/InputText.vue";
import InputTextarea from "@/components/inputs/InputTextarea.vue";
import InputButton from "@/components/inputs/InputButton.vue";
import {ref} from "vue";
import {validateWithI18n} from "@/utils/validation";
import {editPictureSpecs} from "@/modules/gallery/validations/picture";

const props = defineProps({
    originalPicture: {
        type: Object,
        default: {}
    },
    shown: {
        type: Boolean,
        default: false
    },
    fieldErrors: {
        type: Object,
        default: {}
    }
});

const picture = ref(props.originalPicture);

const emit = defineEmits(['update', 'error'])

function update() {
    validateWithI18n(editPictureSpecs, picture.value)
        .then(validated => emit('update', validated))
        .catch(e => emit('error', e))
}

</script>

<template>
    <modal-content :shown="shown">
        <template v-slot:header>{{ $t('Gallery.ModalCreatePicture.TitleModal') }}</template>

        <template v-slot:default>
            <input-text v-model="picture.title" :text-label="$t('Gallery.ModalUpdatePicture.TitleLabel')" name="title"
                        :error="props.fieldErrors.title" @keyup="props.fieldErrors.title = null"/>

            <input-text v-model="picture.system_path" :text-label="$t('Gallery.ModalUpdatePicture.SystemPathLabel')" name="system_path"
                        :error="props.fieldErrors.system_path" @keyup="props.fieldErrors.system_path = null"/>

            <input-textarea v-model="picture.description" :text-label="$t('Gallery.ModalUpdatePicture.DescriptionLabel')" name="description"
                            :error="props.fieldErrors.description" @keyup="props.fieldErrors.description = null"/>

            <input-button @click="update">{{ $t('Gallery.ModalUpdatePicture.SubmitButtonLabel') }}</input-button>
        </template>
    </modal-content>
</template>