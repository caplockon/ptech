<script setup>
import BaseCard from "@/components/cards/BaseCard.vue";
import PrimaryButton from "@/components/buttons/PrimaryButton.vue";
import AlternativeButton from "@/components/buttons/AlternativeButton.vue";
import IconCloudArrowUp from "@/components/icons/IconCloudArrowUp.vue";
</script>

<template>
    <base-card>
        <img class="mb-4 rounded-lg w-28 h-28 sm:mb-0 xl:mb-4 2xl:mb-0" src="https://flowbite-admin-dashboard.vercel.app/images/users/bonnie-green-2x.png" alt="Jese picture">
        <div>
            <h3 class="mb-1 text-xl font-bold text-gray-900 dark:text-white">Profile picture</h3>
            <div class="mb-4 text-sm text-gray-500 dark:text-gray-400">
                JPG, GIF or PNG. Max size of 800K
            </div>
            <div class="flex items-center space-x-4">
                <primary-button :icon="IconCloudArrowUp">Upload Picture</primary-button>
                <alternative-button>Delete</alternative-button>
            </div>
        </div>
    </base-card>
</template>