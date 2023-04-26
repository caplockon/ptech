<script setup>
import {useMenuStore} from "@/stores/menu";
import MenuItemTopLevel from "@/components/partials/sidebar/MenuItemTopLevel.vue";
import MenuItemTopLevelWithChildren from "@/components/partials/sidebar/MenuItemTopLevelWithChildren.vue";

const menu = useMenuStore();

</script>
<template>

    <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
        <ul class="space-y-2 font-medium">
            <template v-for="item in menu.items">
                <menu-item-top-level v-if="!item.children" v-bind="item"/>
                <menu-item-top-level-with-children v-if="!!item.children" v-bind="item"/>
            </template>
        </ul>
    </div>
</template>