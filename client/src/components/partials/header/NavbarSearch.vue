<script setup>
import IconMagnifyingGlass from "@/components/icons/IconMagnifyingGlass.vue";
</script>
<template>
    <form action="#" method="GET" class="hidden lg:block lg:pl-3.5">
        <label for="topbar-search" class="sr-only">Search</label>
        <div class="relative mt-1 lg:w-96">
            <div class="absolute z-10 text-gray-400 inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <icon-magnifying-glass class="w-5 h-5"/>
            </div>
            <input type="text" name="email" id="topbar-search" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Search">
        </div>
    </form>
</template>