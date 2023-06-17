<script setup>
import {computed, onMounted, ref, shallowRef} from "vue";
import IconPencilSquare from "@/components/icons/IconPencilSquare.vue";
import IconTrash from "@/components/icons/IconTrash.vue";
import {initDropdowns} from "flowbite";

const props = defineProps(['item']);

const options = ref([
    {
        label: 'Edit',
        name: 'edit',
        icon: shallowRef(IconPencilSquare),
    },
    {
        label: 'Delete',
        name: 'delete',
        icon: shallowRef(IconTrash)
    }
]);

const enabledOptions = computed(() => options.value);
const emit = defineEmits(['edit', 'delete']);

function emitEvent(selectedOption) {
    emit(selectedOption.name, props.item)
}

onMounted(() => {
    initDropdowns();
});

</script>

<template>
    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownHoverButton">
        <li v-for="item in enabledOptions">
            <a href="#" @click="emitEvent(item)" class="flex items-center block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                <component v-bind:is="item.icon" class="w-5 h-5 inline-block mr-2"></component>
                {{item.label}}
            </a>
        </li>
    </ul>
</template>