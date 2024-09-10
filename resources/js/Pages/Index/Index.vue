<template>
    <div class="p-4">
        <!-- <Link :href="route('test.ziggy')">go to test.ziggy</Link> -->
        {{ message }}
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
    message: String,
});
</script>
