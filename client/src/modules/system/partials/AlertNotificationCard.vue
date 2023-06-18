<script setup>

import BaseCard from "@/components/cards/BaseCard.vue";
import PrimaryButton from "@/components/buttons/PrimaryButton.vue";
</script>
<template>
    <base-card>
        <h3 class="text-xl font-semibold dark:text-white">Alerts &amp; Notifications</h3>
        <p class="text-sm font-normal text-gray-500 dark:text-gray-400">You can set up Themesberg to get notifications</p>
        <div class="divide-y divide-gray-200 dark:divide-gray-700">
            <!-- Item 1 -->
            <div class="flex items-center justify-between py-4">
                <div class="flex flex-col flex-grow">
                    <div class="text-lg font-semibold text-gray-900 dark:text-white">Company News</div>
                    <div class="text-base font-normal text-gray-500 dark:text-gray-400">Get Themesberg news, announcements, and product updates</div>
                </div>
                <label for="company-news" class="relative flex items-center cursor-pointer">
                    <input type="checkbox" id="company-news" class="sr-only">
                    <span class="h-6 bg-gray-200 border border-gray-200 rounded-full w-11 toggle-bg dark:bg-gray-700 dark:border-gray-600"></span>
                </label>
            </div>
            <!-- Item 2 -->
            <div class="flex items-center justify-between py-4">
                <div class="flex flex-col flex-grow">
                    <div class="text-lg font-semibold text-gray-900 dark:text-white">Account Activity</div>
                    <div class="text-base font-normal text-gray-500 dark:text-gray-400">Get important notifications about you or activity you've missed</div>
                </div>
                <label for="account-activity" class="relative flex items-center cursor-pointer">
                    <input type="checkbox" id="account-activity" class="sr-only" checked="">
                    <span class="h-6 bg-gray-200 border border-gray-200 rounded-full w-11 toggle-bg dark:bg-gray-700 dark:border-gray-600"></span>
                </label>
            </div>
            <!-- Item 3 -->
            <div class="flex items-center justify-between py-4">
                <div class="flex flex-col flex-grow">
                    <div class="text-lg font-semibold text-gray-900 dark:text-white">Meetups Near You</div>
                    <div class="text-base font-normal text-gray-500 dark:text-gray-400">Get an email when a Dribbble Meetup is posted close to my location</div>
                </div>
                <label for="meetups" class="relative flex items-center cursor-pointer">
                    <input type="checkbox" id="meetups" class="sr-only" checked="">
                    <span class="h-6 bg-gray-200 border border-gray-200 rounded-full w-11 toggle-bg dark:bg-gray-700 dark:border-gray-600"></span>
                </label>
            </div>
            <!-- Item 4 -->
            <div class="flex items-center justify-between pt-4">
                <div class="flex flex-col flex-grow">
                    <div class="text-lg font-semibold text-gray-900 dark:text-white">New Messages</div>
                    <div class="text-base font-normal text-gray-500 dark:text-gray-400">Get Themsberg news, announcements, and product updates</div>
                </div>
                <label for="new-messages" class="relative flex items-center cursor-pointer">
                    <input type="checkbox" id="new-messages" class="sr-only">
                    <span class="h-6 bg-gray-200 border border-gray-200 rounded-full w-11 toggle-bg dark:bg-gray-700 dark:border-gray-600"></span>
                </label>
            </div>
        </div>
        <div class="mt-6">
            <primary-button>Save all</primary-button>
        </div>
    </base-card>
</template>