<script setup>
import {useToast} from "@/stores/toast";
import BaseToast from "@/components/toasts/BaseToast.vue";

const toast = useToast();

function deleteToast(item) {
    toast.remove(item.uuid);
}
</script>
<template>
    <div class="fixed bottom-0 right-0 z-50 w-80 h-auto mr-1 mb-2">
        <div class="block w-full flex" v-for="toast in toast.getShownItems()">
            <component v-if="!!toast.component" v-bind:is="toast.component"/>
            <base-toast v-else :toast="toast" @close-toast="deleteToast"/>
        </div>
    </div>
</template>