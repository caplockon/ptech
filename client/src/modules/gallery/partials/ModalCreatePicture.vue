<script setup>
import ModalContent from "@/components/modals/ModalContent.vue";
import InputText from "@/components/inputs/InputText.vue";
import InputTextarea from "@/components/inputs/InputTextarea.vue";
import InputButton from "@/components/inputs/InputButton.vue";
import {ref, watch} from "vue";
import {createPictureSpecs} from "@/modules/gallery/validations/picture";
import {validateWithI18n} from "@/utils/validation";
import {touchLog} from "@/utils/filters";


const refreshedPicture = function () {
    return {
        title: null,
        description: null,
        system_path: null,
    }
}

const picture = ref(refreshedPicture());

const props = defineProps({
    fieldErrors: {
        type: Object,
        default: {}
    },
    modalError: {
        type: String,
        default: ''
    },
    shown: {
        type: Boolean,
        default: false
    }
})

const emit = defineEmits(['create', 'error'])

function create() {
    validateWithI18n(createPictureSpecs, picture.value)
        .then(validated => emit('create', touchLog(validated)))
        .catch(e => emit('error', touchLog(e)))
}

watch(() => props.shown, () => picture.value = refreshedPicture())
</script>

<template>

    <modal-content :shown="shown">
        <template v-slot:header>{{ $t('Gallery.ModalCreatePicture.TitleModal') }}</template>

        <template v-slot:default>

            <input-text v-model="picture.title" :text-label="$t('Gallery.ModalCreatePicture.TitleLabel')" name="title"
                        :error="props.fieldErrors.title" @keyup="props.fieldErrors.title = null"/>

            <input-text v-model="picture.system_path" :text-label="$t('Gallery.ModalCreatePicture.SystemPathLabel')" name="system_path"
                        :error="props.fieldErrors.system_path" @keyup="props.fieldErrors.system_path = null"/>

            <input-textarea v-model="picture.description" :text-label="$t('Gallery.ModalCreatePicture.DescriptionLabel')" name="description"
                            :error="props.fieldErrors.description" @keyup="props.fieldErrors.description = null"/>

            <input-button @click="create">{{ $t('Gallery.ModalCreatePicture.SubmitButtonLabel') }}</input-button>

            <p class="block mt-2 text-sm text-red-700 dark:text-red-500" v-if="props.modalError" v-html="props.modalError"></p>
        </template>

    </modal-content>

</template>