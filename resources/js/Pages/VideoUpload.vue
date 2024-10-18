<template>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Video Upload</h1>
        <div class="mb-4">
            <input type="file" id="fileInput" accept="video/*" class="mb-2" />
            <div
                id="progressBarContainer"
                class="w-full bg-gray-200 rounded-full h-5 dark:bg-gray-700"
            >
                <div
                    id="progressBar"
                    class="bg-blue-600 h-5 rounded-full text-sm"
                    style="width: 0%"
                ></div>
            </div>
            <div id="statusMessage" class="mt-2"></div>
        </div>

        <div class="grid grid-cols-6 gap-4 mt-8">
            <div
                v-for="video in videos"
                :key="video.id"
                class="border p-4 rounded"
            >
                <!-- <h2 class="text-xs">{{ video.title }}</h2> -->
                <video
                    :src="'/storage/' + video.path"
                    autoplay
                    controls
                    loop
                    muted
                    class="w-full"
                ></video>
            </div>
        </div>
    </div>
</template>

<script>
import { onMounted } from "vue";
import { initializeUpload } from "../chunked-upload.js";

export default {
    props: {
        videos: Array,
    },
    setup() {
        onMounted(() => {
            initializeUpload("fileInput", "progressBar", "statusMessage");
        });

        return {};
    },
};
</script>
