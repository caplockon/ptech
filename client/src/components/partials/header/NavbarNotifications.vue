<script setup>
import IconBell from "@/components/icons/IconBell.vue";
import {ref} from "vue";
import IconCamera from "@/components/icons/IconCamera.vue";
import IconHeart from "@/components/icons/IconHeart.vue";
import IconChatBubbleOvalLeftEllipsis from "@/components/icons/IconChatBubbleOvalLeftEllipsis.vue";
import IconEye from "@/components/icons/IconEye.vue";

const notifications = ref([
    {
        avatar: 'https://flowbite.com/docs/images/people/profile-picture-5.jpg',
        type: IconCamera,
        description: 'New message',
        time: 'a few moments ago'
    },
    {
        avatar: 'https://flowbite.com/docs/images/people/profile-picture-5.jpg',
        type: IconHeart,
        description: 'New message',
        time: 'a few moments ago'
    },
    {
        avatar: 'https://flowbite.com/docs/images/people/profile-picture-5.jpg',
        type: IconChatBubbleOvalLeftEllipsis,
        description: 'New message',
        time: 'a few moments ago'
    },
    {
        avatar: 'https://flowbite.com/docs/images/people/profile-picture-5.jpg',
        type: IconCamera,
        description: 'New message',
        time: 'a few moments ago'
    }
])
</script>
<template>
    <button type="button" data-dropdown-toggle="notification-dropdown" class="p-2 text-gray-500 rounded-lg hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-700">
        <span class="sr-only">View notifications</span>
        <!-- Bell icon -->
        <icon-bell class="w-6 h-6"/>
    </button>
    <!-- Dropdown menu -->
    <div class="z-20 z-50 w-96 hidden max-w-sm my-4 overflow-hidden text-base list-none bg-white divide-y divide-gray-100 rounded shadow-lg dark:divide-gray-600 dark:bg-gray-700" id="notification-dropdown">
        <div class="block px-4 py-2 text-base font-medium text-center text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            Notifications
        </div>
        <div>
            <a v-for="item in notifications" href="#" class="flex px-4 py-3 border-b hover:bg-gray-100 dark:hover:bg-gray-600 dark:border-gray-600">
                <div class="flex-shrink-0">
                    <img class="rounded-full w-11 h-11" :src="item.avatar" alt="Jese image">
                    <div class="absolute bg-green-400 flex items-center justify-center w-5 h-5 ml-6 -mt-5 border border-white rounded-full bg-primary-700 dark:border-gray-700">
                        <component v-bind:is="item.type" class="w-3 h-3 text-white "></component>
                    </div>
                </div>
                <div class="w-full pl-3">
                    <div class="text-gray-500 font-normal text-sm mb-1.5 dark:text-gray-400">{{item.description}}</div>
                    <div class="text-xs font-medium text-primary-700 dark:text-primary-400">{{item.time}}</div>
                </div>
            </a>
        </div>
        <a href="#" class="block py-2 text-base font-normal text-center text-gray-900 bg-gray-50 hover:bg-gray-100 dark:bg-gray-700 dark:text-white dark:hover:underline">
            <div class="inline-flex items-center ">
                <icon-eye class="w-5 h-5 mr-2"/> View all
            </div>
        </a>
    </div>
</template>