<script setup>
import BaseLayout from "@/components/BaseLayout.vue";
import InputText from "@/components/inputs/InputText.vue";
import InputTextarea from "@/components/inputs/InputTextarea.vue";
import InputButton from "@/components/inputs/InputButton.vue";
import {useSystemConfig, useUpload} from "@/services/ptech";
import {computed, onMounted, ref} from "vue";
import InputImage from "@/components/inputs/InputImage.vue";
import {touchLog} from "@/utils/filters";

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
    <base-layout>
        <div class="sm:mr-64">

            <h2 class="mb-4 text-xl font-bold leading-none tracking-tight text-gray-900 md:text-2xl dark:text-white">Setup Site Owner</h2>

            <div>
                <input-text text-label="Owner Name" v-model="owner.owner_name"/>

                <input-image text-label="Avatar" v-model="localAvatar" :link="owner.owner_avatar"/>

                <input-text text-label="Job Title" v-model="owner.job_title"/>

                <input-textarea text-label="Description" rows="7" v-model="owner.description"/>

                <input-button @click="saveOwner">Save</input-button>

            </div>
        </div>
    </base-layout>
</template>