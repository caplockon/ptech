<script setup>
import InputText from "@/components/inputs/InputText.vue";
import InputTextarea from "@/components/inputs/InputTextarea.vue";
import InputButton from "@/components/inputs/InputButton.vue";
import {useSystemConfig, useUpload} from "@/services/ptech";
import {onMounted, ref} from "vue";
import InputImage from "@/components/inputs/InputImage.vue";
import DashboardLayout from "@/components/DashboardLayout.vue";

const owner = ref({
    owner_name: null,
    job_title: null,
    description: null,
    owner_avatar: null
})

const localAvatar = ref(null)

onMounted(() => {
    useSystemConfig()
        .fetch(['owner_name', 'job_title', 'description', 'owner_avatar'])
        .then(res => owner.value = res);
});

async function saveOwner() {
    try {
        if (!!localAvatar.value && localAvatar.value.length > 0) {
            const result = await useUpload().uploadImage(localAvatar.value[0]);
            owner.value.owner_avatar = result.file;
        }
        await useSystemConfig().update(owner.value);
    } catch (e) {}
}
</script>

<template>
    <dashboard-layout>
        <div class="px-4 pt-6">
            <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                <!-- Card header -->
                <div class="items-center justify-between lg:flex">
                    <div class="mb-4 lg:mb-0">
                        <h3 class="mb-2 text-xl font-bold text-gray-900 dark:text-white">Setup Site Owner</h3>
                        <span class="text-base font-normal text-gray-500 dark:text-gray-400">Let others know about the owner of the website</span>
                    </div>
                </div>

                <div class="mt-5">
                    <div>
                        <input-text text-label="Owner Name" v-model="owner.owner_name"/>

                        <input-image text-label="Avatar" v-model="localAvatar" :link="owner.owner_avatar"/>

                        <input-text text-label="Job Title" v-model="owner.job_title"/>

                        <input-textarea text-label="Description" rows="7" v-model="owner.description"/>

                        <input-button @click="saveOwner">Save</input-button>

                    </div>
                </div>
            </div>
        </div>
    </dashboard-layout>
</template>