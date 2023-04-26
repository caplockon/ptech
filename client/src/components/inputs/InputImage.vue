<script>
export default {
    inheritAttrs: false
}
</script>

<script setup>
import {getClasses, sizeEnums} from "@/components/inputs/setup";
import {computed, onMounted, ref} from "vue";
import IconPencilSquare from "@/components/icons/IconPencilSquare.vue";

const props = defineProps({
    modelValue: Object,
    textLabel: String,
    error: {
        type: String,
        default: ''
    },
    disabled: Boolean,
    size: {
        type: String,
        default: 'md',
        validator: (value) => {
            return sizeEnums.includes(value)
        }
    },
    link: String
});

const displayImage = computed(() => {
    return props.modelValue && props.modelValue && props.modelValue.length > 0
        ? URL.createObjectURL(props.modelValue[0])
        : props.link;
})

const labelClasses = computed(() => getClasses('InputLabel', props));
const inputClasses = computed(() => {
    if (!displayImage.value) {
        return getClasses('InputFile', props)
    }

    return ['w-full h-full','absolute top-0 left-0', 'z-40', 'opacity-0', 'cursor-pointer'];
});

const inputErrorClasses = computed(() => getClasses('InputErrorText', props));

defineEmits(['update:modelValue']);
</script>

<template>
    <div class="mb-6">
        <div>
            <label :class="labelClasses" :for="$attrs.id">{{ textLabel }}</label>
            <div class="relative" :class="{'rounded-md border p-1 max-w-xs': displayImage}">
                <img v-if="displayImage" :src="displayImage" :alt="displayImage" class="w-full"/>
                <IconPencilSquare v-if="displayImage" class="absolute w-6 h-6 right-2 top-2 z-30"/>
                <input accept="image/*" v-bind="$attrs" :class="inputClasses" @input="$emit('update:modelValue', $event.target.files)" type="file">
            </div>
            <p v-if="!!error" :class="inputErrorClasses">{{ error }}</p>
        </div>
    </div>
</template>