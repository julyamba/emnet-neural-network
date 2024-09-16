<template>
    <form @submit.prevent="filter">
        <div class="mb-8 mt-4 flex flex-wrap gap-2">
            <!-- <div class="flex flex-nowrap items-center">
                <input v-model.number="filterForm.priceFrom" placeholder="Price from" class="input-filter-l w-28" />
                <input v-model.number="filterForm.priceTo" placeholder="Price to" class="input-filter-r w-28" />
            </div>

            <div class="flex flex-nowrap items-center">
                <select v-model="filterForm.beds" class="input-filter-l w-28">
                    <option :value="null">Beds</option>
                    <option v-for="n in 5" :key="n" :value="n">{{ n }}</option>
                    <option>6+</option>
                </select>
                <select v-model="filterForm.baths" class="input-filter-r w-28">
                    <option :value="null">Baths</option>
                    <option v-for="n in 5" :key="n" :value="n">{{ n }}</option>
                    <option>6+</option>
                </select>
            </div> -->

            <div class="flex flex-nowrap items-center">
                <input
                    v-model.number="filterForm.name"
                    placeholder="Title"
                    class="input-filter-l w-28"
                />
                <input
                    v-model.number="filterForm.owner"
                    placeholder="Created by"
                    class="input-filter-r w-28"
                />
                <select
                    v-model="filterForm.orderBy"
                    class="input-filter-lr w-28 ml-2"
                >
                    <option :value="null">Order by</option>
                    <option value="latest">Latest</option>
                    <option value="oldest">Oldest</option>
                </select>
            </div>

            <button type="submit" class="btn-normal px-5">Filter</button>
            <button type="reset" @click="clear" class="px-4 btn-outline">
                Clear
            </button>
        </div>
    </form>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";

const props = defineProps({ filters: Object });

const filterForm = useForm({
    name: props.filters.name ?? null,
    orderBy: props.filters.orderBy ?? null,
    owner: props.filters.owner ?? null,
});

const filter = () => {
    filterForm.get(route("project.index"), {
        preserveState: true,
        preserveScroll: true,
    });
};

const clear = () => {
    filterForm.name = null;
    filterForm.orderBy = null;
    filterForm.owner = null;
    filter();
};
</script>
