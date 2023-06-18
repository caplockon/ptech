<script setup>
import {computed} from "vue";

const props = defineProps({
    size: {
        type: String,
        default: 'md'
    },
    scheme: {
        type: String,
        default: 'default'
    },
    rounded: {
        type: Boolean,
        default: true
    },
    type: {
        type: String,
        default: 'button'
    },
    iconOnly: {
        type: Boolean,
        default: false
    },
    icon: {}
});

const sizes = {
    'xs': 'px-3 py-2 text-xs font-medium',
    'sm': 'px-3 py-2 text-sm font-medium',
    'md': 'px-5 py-2.5 text-sm font-medium',
    'lg': 'px-5 py-3 text-base font-medium',
    'xl': 'px-6 py-3.5 text-base font-medium',
};

const px = computed(() => {
    let sizes = {
        'xs': 'px-3',
        'sm': 'px-3',
        'md': 'px-3',
        'lg': 'px-3',
        'xl': 'px-3',
    };

    if (!!props.icon) {
        sizes = {
            'xs': 'px-2',
            'sm': 'px-2',
            'md': 'px-4',
            'lg': 'px-4',
            'xl': 'px-5',
        };
    }

    return sizes[props.size] ?? sizes.md;
});

const roundedSizes = {
    'xs': 'rounded-lg',
    'sm': 'rounded-lg',
    'md': 'rounded-lg',
    'lg': 'rounded-lg',
    'xl': 'rounded-lg',
};

const iconSizes = {
    'xs': 'w-4 h-4',
    'sm': 'w-4 h-4',
    'md': 'w-5 h-5',
    'lg': 'w-5 h-5',
    'xl': 'w-6 h-6',
};

const schema = {
    'default': 'text-white bg-blue-700 ' +
        'hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 ' +
        'dark:bg-blue-600 dark:hover:bg-blue-700 ' +
        'focus:outline-none dark:focus:ring-blue-800',

    'alternative': 'text-gray-900 bg-white border border-gray-200 ' +
        'hover:bg-gray-100 hover:text-blue-700 hover:bg-blue-800 ' +
        'focus:z-10 focus:ring-4 focus:ring-gray-200 focus:outline-none focus:ring-4 focus:ring-blue-300 ' +
        'dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 ' +
        'dark:hover:text-white dark:hover:bg-gray-700',

    'dark': 'text-white bg-gray-800 ' +
        'hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 ' +
        'dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700',

    'light': 'text-gray-900 bg-white border border-gray-300 ' +
        'focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 ' +
        'dark:bg-gray-800 dark:text-white dark:border-gray-600 ' +
        'dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700',

    'green': 'focus:outline-none text-white bg-green-700 ' +
        'hover:bg-green-800 focus:ring-4 focus:ring-green-300 ' +
        'dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800',

    'red': 'focus:outline-none text-white bg-red-700 ' +
        'hover:bg-red-800 focus:ring-4 focus:ring-red-300 ' +
        'dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900',

    'yellow': 'focus:outline-none text-white bg-yellow-400 ' +
        'hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 ' +
        'dark:focus:ring-yellow-900',

    'purple': 'focus:outline-none text-white bg-purple-700 ' +
        'hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 ' +
        'dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900'
};

const classes = computed(() => {
    const list = [];
    list.push('inline-flex items-center');
    list.push(sizes[props.size] ?? sizes.md);
    list.push(schema[props.scheme] ?? schema.default);
    list.push(px);

    if (props.rounded) {
        list.push(roundedSizes[props.size] ?? roundedSizes.md);
    }

    return list.join(' ');
});

const iconSizeClasses = computed(() => {
    const list = [];
    list.push(iconSizes[props.size] ?? iconSizes.md);
    if (! props.iconOnly) {
        list.push('mr-2')
    }

    return list.join(' ');
})
</script>
<template>
    <button :type="props.type"
            :class="classes">
        <component v-bind:is="props.icon" :class="iconSizeClasses"></component>
        <slot v-if="!props.iconOnly"></slot>
    </button>
</template>