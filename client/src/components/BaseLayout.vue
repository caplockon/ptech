<script setup>
import Navbar from "@/components/partials/header/Navbar.vue";
import SiteInfo from "@/components/partials/footer/SiteInfo.vue";
import Sidebar from "@/components/partials/sidebar/Sidebar.vue";
</script>

<template>
    <slot name="starting"></slot>
    <header>
        <navbar/>
    </header>
    <div class="relative">
        <aside id="sidebar-multi-level-sidebar" class="border-r fixed top-16 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
            <sidebar/>
        </aside>
        <main class="p-4 sm:ml-64">
            <slot></slot>
        </main>
    </div>
<!--    <footer class="fixed bottom-0 left-0 w-full">-->
<!--        <site-info/>-->
<!--    </footer>-->
    <slot name="ending"></slot>
</template>