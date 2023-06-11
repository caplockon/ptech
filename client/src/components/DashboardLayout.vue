<script setup>
import {
    initAccordions,
    initCarousels,
    initCollapses,
    initDials,
    initDismisses,
    initDrawers,
    initDropdowns,
    initModals,
    initPopovers,
    initTabs,
    initTooltips
} from "flowbite";
import {onMounted} from "vue";
import DashboardNavbar from "@/components/partials/DashboardNavbar.vue";
import DashboardSidebar from "@/components/partials/DashboardSidebar.vue";
import DashboardFooter from "@/components/partials/DashboardFooter.vue";

onMounted(() => {
    initDropdowns();
    initAccordions();
    initCarousels();
    initCollapses();
    initDials();
    initDismisses();
    initDrawers();
    initDropdowns();
    initModals();
    initPopovers();
    initTabs();
    initTooltips();
})
</script>

<template>
    <slot name="starting"></slot>

    <dashboard-navbar/>

    <div class="flex pt-16 overflow-hidden bg-gray-50 dark:bg-gray-900">

        <dashboard-sidebar/>

        <div id="main-content" class="relative w-full h-full overflow-y-auto bg-gray-50 lg:ml-64 dark:bg-gray-900">
            <main>
                <slot></slot>
            </main>

            <dashboard-footer/>

        </div>

    </div>

    <slot name="ending"></slot>

</template>
