<script setup>
import IconXMark from "@/components/icons/IconXMark.vue";
import BaseButton from "@/components/buttons/BaseButton.vue";
import {computed, onMounted, ref, watch} from "vue";
import {getStateClasses, hideModal, showModal} from "@/utils/modal";

const props = defineProps({
    confirmLabel: {
        type: String,
        default: null,
    },
    confirmScheme: {
        type: String,
        default: 'info',
    },
    cancelLabel: {
        type: String,
        default: null,
    },
    cancelScheme: {
        type: String,
        default: 'light',
    },
    buttonSize: {
        type: String,
        default: 'md',
    },
    buttonCancel: {
        type: Boolean,
        default: true,
    },
    buttonConfirm: {
        type: Boolean,
        default: true,
    },
    shown: {
        type: Boolean,
        default: false,
    },
});

const shown = ref(props.shown);

function show() {
    showModal(() => shown.value = true);
}

function hide() {
    hideModal(() => shown.value = false)
}

const modalClasses = computed(() => {
    return getStateClasses(shown.value);
});

watch(props, () => {
    props.shown ? show() : hide();
});

onMounted(() => {
    shown.value && show();
})

const emit = defineEmits(['confirm', 'dismiss']);
</script>
<template>
    <div :class="modalClasses" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button @click="() => emit('dismiss')" type="button" class="cursor-pointer z-50 absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="popup-modal">
                    <icon-x-mark aria-hidden="true" class="w-5 h-5"/>
                    <span class="sr-only">Close modal</span>
                </button>

                <div class="p-6 text-center">

                    <slot></slot>

                    <base-button v-if="props.buttonConfirm"
                                 @click="() => emit('confirm')"
                                 :size="props.buttonSize"
                                 :scheme="props.confirmScheme"
                                 class="inline-flex items-center"
                    >{{props.confirmLabel ?? $t('PopupModal.ConfirmLabel')}}</base-button>

                    <base-button v-if="props.buttonCancel"
                                 @click="() => emit('dismiss')"
                                 :size="props.buttonSize"
                                 :scheme="props.cancelScheme"
                                 :class="{'ml-2': props.buttonConfirm}"
                                 class="inline-flex items-center"
                    >{{props.cancelLabel ?? $t('PopupModal.CancelLabel')}}</base-button>
                </div>
            </div>
        </div>
    </div>
</template>