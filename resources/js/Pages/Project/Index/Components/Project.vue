<template>
    <Box>
        <div>
            <Link :href="route('project.show', { project })">
                <div class="">
                    <div class="text-2xl font-bold">
                        <p>{{ project.name }}</p>
                    </div>
                    <div class="text-xs text-gray-500">
                        <p>Created by: {{ project.owner.name }}</p>
                    </div>
                </div>
            </Link>
        </div>
    </Box>
</template>

<script setup>
import Box from "@/Components/UI/Box.vue";
import { Link } from "@inertiajs/vue3";

defineProps({
    project: Object,
});
</script>
