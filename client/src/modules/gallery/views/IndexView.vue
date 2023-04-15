<script setup>
import {computed, onMounted, ref} from "vue";
import {useGallery} from "@/services/ptech";
import {datetime, touchLog, cmpObj, createOnceAction} from "@/utils/filters";
import moment from "moment";

const albumList = ref([]);
const pictureList = ref([]);
const sortedBy = ref({field: 'created_at', type: 'desc'});
const selectedAlbum = ref(null);

const selectAlbumAction = createOnceAction();

function getPictures(album) {
    useGallery().album(album.uuid).getPictures().then(pictures => {
        pictureList.value = touchLog(pictures);
    })
}

function formatPictureCreatedAt(value) {
    const timestamp = (new Date(value)).getTime();
    const _5hoursAgo = 1000*60*60*5;
    const _1YearAgo = 1000*60*60*24*360;

    if (timestamp > _5hoursAgo || timestamp < _1YearAgo) {
        return moment(timestamp).fromNow();
    }

    return datetime(value, 'lll')
}

onMounted(() => {
    useGallery().getAlbums().then(albums => {
        albumList.value = touchLog(albums);

        if (albums.length > 0) {
            selectAlbum(albums[0]);
        }
    })
})

const sortedPictureList = computed(() => {
    return pictureList.value.sort((pic1, pic2) => {
        const result = cmpObj(pic1, pic2, [sortedBy.value.field]);
        return result * (sortedBy.value.type === "desc" ? -1 : 1);
    })
})

function isSelectedAlbum(album) {
    return !!selectedAlbum.value && selectedAlbum.value.uuid === album.uuid;
}

function selectAlbum(album) {
    if (isSelectedAlbum(album)) {
        return;
    }

    selectAlbumAction(() => {
        selectedAlbum.value = album;
        getPictures(album);
    })
}

</script>

<template>

    <button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar" aria-controls="default-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ml-3 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
        <span class="sr-only">Open sidebar</span>
        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
        </svg>
    </button>

    <aside id="default-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
        <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
            <ul class="space-y-2 font-medium">

                <li v-for="album in albumList">
                    <a @click="selectAlbum(album)" href="#"
                       class="flex items-center text-gray-900 p-2 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700"
                       :class="{'bg-gray-100 dark:bg-gray-700': isSelectedAlbum(album)}"
                    >
                        <img :src="album.thumbnail" class="w-6 h-6 rounded"/>
                        <span class="ml-3">{{album.name}}</span>
                    </a>
                </li>

                <li>
                    <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                        <span class="text-gray-400 dark:text-gray-500">+ Create Album</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>

    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">

            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3 w-16">
                            Thumb.
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Title
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Created At
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="picture in sortedPictureList" class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <img :src="picture.system_path" class="w-12 h-12 rounded"/>
                        </th>
                        <td class="px-6 py-4">
                            {{ picture.title }}
                        </td>
                        <td class="px-6 py-4">
                            {{ formatPictureCreatedAt(picture.created_at) }}
                        </td>
                        <td class="px-6 py-4">
                            <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Delete</a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <div class="flex mt-2 items-center justify-center mb-4 rounded bg-gray-50 dark:bg-gray-800">
                <a href="#" class="text-2xl text-gray-400 dark:text-gray-500">+</a>
            </div>
        </div>
    </div>
</template>
