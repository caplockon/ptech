<script setup xmlns:template="http://www.w3.org/1999/html">
import ModalContent from "@/components/modals/ModalContent.vue";
import InputButton from "@/components/inputs/InputButton.vue";

const props = defineProps({
    shown: {
        type: Boolean,
        default: false
    }
})


defineEmits(['confirm']);
</script>

<template>
    <modal-content :shown="shown">
        <template v-slot:header>Confirm</template>

        <template v-slot:default>
            <p>Are you sure to delete this picture?</p>
            <input-button @click="$emit('confirm')">Yes</input-button>
        </template>
    </modal-content>
</template>