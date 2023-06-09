<script setup>
import {computed, onMounted, ref, watch} from "vue";
import IconXMark from "@/components/icons/IconXMark.vue";
import AlternativeButton from "@/components/buttons/AlternativeButton.vue";
import {getStateClasses, hideModal, showModal} from "@/utils/modal";

const props = defineProps({
    shown: {
        type: Boolean,
        default: false,
    },
    dismissible: {
        type: Boolean,
        default: true,
    },
    header: {
        type: Boolean,
        default: true
    },
    footer: {
        type: Boolean,
        default: true
    }
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

const emit = defineEmits(['dismiss']);
function dismiss() {
    emit('dismiss');
}
</script>

<template>
    <div :class="modalClasses" v-bind="$attrs" tabindex="-1" aria-hidden="true" class="modal-backdrop fixed top-0 left-0 right-0 z-50 w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div v-if="props.header" class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        <slot name="header"></slot>
                    </h3>
                    <button v-if="props.dismissible" @click="dismiss" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <icon-x-mark aria-hidden="true" class="w-5 h-5"/>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>

                <!-- Modal body -->
                <div class="p-6 space-y-6">
                    <slot></slot>
                </div>

                <!-- Modal footer -->
                <div v-if="props.footer" class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <slot name="footer"></slot>
                    <alternative-button v-if="props.dismissible" @click="dismiss">Cancel</alternative-button>
                </div>
            </div>
        </div>
    </div>
</template>