<script setup>
import IconXMark from "@/components/icons/IconXMark.vue";
import {computed} from "vue";
import IconCheck from "@/components/icons/IconCheck.vue";
import IconExclamationTriangle from "@/components/icons/IconExclamationTriangle.vue";
import IconInformationCircle from "@/components/icons/IconInformationCircle.vue";

const props = defineProps({
    toast: {
        type: Object,
        default: {
            status: 'info',
            icon: false,
            message: null,
            closable: false
        }
    }
});

const statusMap = {
    'info':     'text-blue-500 bg-blue-100 dark:bg-blue-800 dark:text-blue-200',
    'success':  'text-green-500 bg-green-100 dark:bg-green-800 dark:text-green-200',
    'danger':   'text-red-500 bg-red-100 dark:bg-red-800 dark:text-red-200',
    'warning':  'text-orange-500 bg-orange-100 dark:bg-orange-700 dark:text-orange-200'
};

const iconMap = {
    'info':     IconInformationCircle,
    'success':  IconCheck,
    'danger':   IconXMark,
    'warning':  IconExclamationTriangle
};

const status = computed(() => {
    return statusMap[props.toast.status] ?? statusMap.info;
});

const icon = computed(() => {
    if (typeof props.toast.icon === "boolean" && props.toast.icon === true) {
        return iconMap[props.toast.status] ?? iconMap.info;
    }

    return props.toast.icon;
});

const emit = defineEmits(['closeToast']);
</script>
<template>
    <div class="border flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow-lg dark:text-gray-400 dark:bg-gray-800" role="alert">

        <div v-if="icon"
             class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 rounded-lg"
             :class="status"
        >
            <component v-bind:is="icon" aria-hidden="true" class="w-5 h-5"></component>
        </div>

        <div class="ml-3 text-sm font-normal">{{props.toast.message}}</div>
        <button v-if="props.toast.closable" @click.prevent="() => emit('closeToast', props.toast)" type="button"
                class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400
                hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300
                p-1.5 hover:bg-gray-100 inline-flex h-8 w-8 dark:text-gray-500
                dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
                data-dismiss-target="#toast-success" aria-label="Close"
        >
            <span class="sr-only">Close</span>
            <icon-x-mark aria-hidden="true" class="w-5 h-5"/>
        </button>
    </div>
</template>