<template>
    <Filters :filters="filters" />
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
        <Project
            v-for="project in projects.data"
            :key="project.id"
            :project="project"
        />
    </div>

    <div v-if="projects.data.length" class="w-full flex mb-4 mt-12">
        <Pagination :links="projects.links" />
    </div>
</template>

<script setup>
import Project from "@/Pages/Project/Index/Components/Project.vue";
import Pagination from "@/Components/UI/Pagination.vue";
import Filters from "@/Pages/Project/Index/Components/Filters.vue";

defineProps({
    projects: Object,
    filters: Object,
});
</script>
