<script setup>
import IconSquares2x2 from "@/components/icons/IconSquares2x2.vue";
import IconShoppingBag from "@/components/icons/IconShoppingBag.vue";
import {ref, shallowRef} from "vue";
import IconUserCircle from "@/components/icons/IconUserCircle.vue";
import IconInbox from "@/components/icons/IconInbox.vue";
import IconUserGroup from "@/components/icons/IconUserGroup.vue";
import IconCog8Tooth from "@/components/icons/IconCog8Tooth.vue";
import IconArchiveBox from "@/components/icons/IconArchiveBox.vue";
import IconCurrencyDollar from "@/components/icons/IconCurrencyDollar.vue";
import IconReceiptPercent from "@/components/icons/IconReceiptPercent.vue";
import IconArrowLeftOnRectangle from "@/components/icons/IconArrowLeftOnRectangle.vue";

const apps = ref([
    {
        icon: shallowRef(IconShoppingBag),
        label: "Sales"
    },
    {
        icon: shallowRef(IconUserGroup),
        label: "Users"
    },
    {
        icon: shallowRef(IconInbox),
        label: "Inbox"
    },
    {
        icon: shallowRef(IconUserCircle),
        label: "Profile"
    },
    {
        icon: shallowRef(IconCog8Tooth),
        label: "Settings"
    },
    {
        icon: shallowRef(IconArchiveBox),
        label: "Products"
    },
    {
        icon: shallowRef(IconCurrencyDollar),
        label: "Pricing"
    },
    {
        icon: shallowRef(IconReceiptPercent),
        label: "Billing"
    },
    {
        icon: shallowRef(IconArrowLeftOnRectangle),
        label: "Logout"
    },
])
</script>
<template>
    <!-- Apps -->
    <button type="button" data-dropdown-toggle="apps-dropdown" class="hidden p-2 text-gray-500 rounded-lg sm:flex hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-700">
        <span class="sr-only">View notifications</span>
        <!-- Icon -->
        <icon-squares2x2 class="w-6 h-6"/>
    </button>
    <!-- Dropdown menu -->
    <div class="z-20 z-50 hidden max-w-sm w-96 my-4 overflow-hidden text-base list-none bg-white divide-y divide-gray-100 rounded shadow-lg dark:bg-gray-700 dark:divide-gray-600" id="apps-dropdown">
        <div class="block px-4 py-2 text-base font-medium text-center text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            Apps
        </div>
        <div class="grid grid-cols-3 gap-4 p-4">
            <a v-for="item in apps" href="#" class="block p-4 text-center rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600">
                <component v-bind:is="item.icon" class="mx-auto mb-1 text-gray-500 w-7 h-7 dark:text-gray-400"></component>
                <div class="text-sm font-medium text-gray-900 dark:text-white">{{item.label}}</div>
            </a>
        </div>
    </div>
</template>