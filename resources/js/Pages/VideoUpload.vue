<template>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Video Upload</h1>
        <div class="mb-4">
            <input
                type="file"
                id="fileInput"
                accept="video/*"
                multiple
                class="mb-2"
            />
            <div id="progressContainer"></div>
            <div id="statusMessage" class="mt-2"></div>
        </div>

        <div class="grid grid-cols-6 gap-4 mt-8">
            <div
                v-for="video in videos"
                :key="video.id"
                class="border p-4 rounded"
            >
                <h2 class="text-xs mb-2">{{ video.original_name }}</h2>
                <video
                    :src="'/storage/' + video.path"
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
            initializeUpload("fileInput", "progressContainer", "statusMessage");
        });

        return {};
    },
};
</script>
