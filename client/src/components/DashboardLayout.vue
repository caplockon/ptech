<script setup>
import DashboardNavbar from "@/components/partials/DashboardNavbar.vue";
import DashboardSidebar from "@/components/partials/DashboardSidebar.vue";
import DashboardFooter from "@/components/partials/DashboardFooter.vue";
import ToastNotification from "@/components/toasts/ToastNotification.vue";

const props = defineProps({
    footer: {
        type: Boolean,
        default: false
    }
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

            <dashboard-footer v-if="props.footer"/>
        </div>

    </div>

    <slot name="ending"></slot>

    <toast-notification/>
</template>
