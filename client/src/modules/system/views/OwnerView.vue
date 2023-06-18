<script setup>
import DashboardLayout from "@/components/DashboardLayout.vue";
import PageTitle from "@/components/pages/PageTitle.vue";
import ProfilePictureCard from "@/modules/system/partials/ProfilePictureCard.vue";
import GeographicCard from "@/modules/system/partials/GeographicCard.vue";
import SocialAccountsCard from "@/modules/system/partials/SocialAccountsCard.vue";
import AlertNotificationCard from "@/modules/system/partials/AlertNotificationCard.vue";
import EmailNotificationCard from "@/modules/system/partials/EmailNotificationCard.vue";
import SessionCard from "@/modules/system/partials/SessionCard.vue";
import GeneralInformationCard from "@/modules/system/partials/GeneralInformationCard.vue";
</script>

<template>
<dashboard-layout>
    <div class="grid grid-cols-1 px-4 pt-6 xl:grid-cols-3 xl:gap-4 dark:bg-gray-900">
        <div class="mb-4 col-span-full xl:mb-2">
            <page-title>Site Owner</page-title>
        </div>

        <div class="col-span-full xl:col-auto">
            <profile-picture-card/>

            <geographic-card/>

            <social-accounts-card/>
        </div>

        <div class="col-span-2">
            <general-information-card/>

            <session-card/>

            <alert-notification-card/>

            <email-notification-card/>
        </div>
    </div>
</dashboard-layout>
</template>