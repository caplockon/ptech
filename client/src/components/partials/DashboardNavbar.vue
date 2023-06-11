<script setup>
import UserProfile from "@/components/partials/header/UserProfile.vue";
import NavbarApps from "@/components/partials/header/NavbarApps.vue";
import NavbarNotifications from "@/components/partials/header/NavbarNotifications.vue";
import NavbarThemeToggle from "@/components/partials/header/NavbarThemeToggle.vue";
import NavbarSearch from "@/components/partials/header/NavbarSearch.vue";
import IconBars3 from "@/components/icons/IconBars3.vue";
</script>

<template>
    <nav class="fixed z-30 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <div class="px-3 py-3 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start">
                    <button id="toggleSidebarMobile" aria-expanded="true" aria-controls="sidebar" class="p-2 text-gray-600 rounded cursor-pointer lg:hidden hover:text-gray-900 hover:bg-gray-100 focus:bg-gray-100 dark:focus:bg-gray-700 focus:ring-2 focus:ring-gray-100 dark:focus:ring-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                        <icon-bars3 class="w-4 h-4"/>
                    </button>

                    <a href="/" class="flex ml-2 md:mr-24">
                        <img src="https://flowbite.com/application-ui/demo/images/logo.svg" class="h-8 mr-3" alt="FlowBite Logo" />
                        <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">PhucTech</span>
                    </a>

                    <!-- Search -->
                    <navbar-search/>
                </div>

                <div class="flex items-center">
                    <!-- Notifications -->
                    <navbar-notifications/>

                    <!-- Apps -->
                    <navbar-apps/>

                    <!-- Theme toggle -->
                    <navbar-theme-toggle/>

                    <!-- Profile -->
                    <user-profile/>
                </div>
            </div>
        </div>
    </nav>
</template>