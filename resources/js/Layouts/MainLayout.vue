<template>
    <header
        class="border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 w-full"
    >
        <div class="container mx-auto">
            <nav class="p-4 flex items-center justify-between">
                <div
                    class="text-xl text-indigo-600 dark:text-indigo-300 font-bold text-center"
                >
                    <Link href="/">EMNET</Link>
                </div>

                <!-- <div
                    class="text-xl text-indigo-600 dark:text-indigo-300 font-bold text-center"
                >
                    <Link href="/" class="tracking-wide uppercase">EMNET</Link>
                </div> -->

                <div v-if="user" class="flex items-center gap-4">
                    <div class="text-sm text-gray-500">{{ user.name }}</div>
                    <!-- <Link :href="route('project.create')" class="btn-primary">+ New Project</Link> -->
                    <Link href="#" class="btn-primary">+ New Project</Link>
                    <div>
                        <Link
                            :href="route('logout')"
                            as="button"
                            method="DELETE"
                            >Logout</Link
                        >
                    </div>
                </div>
                <div v-else class="flex items-center gap-2">
                    <Link :href="route('user-account.create')">Register</Link>
                    <Link :href="route('login')">Sing-in</Link>
                </div>
            </nav>
        </div>
    </header>

    <main class="container mx-auto p-4 w-full">
        <!-- <div v-if="flashSuccess"
            class="mb-4 border rounded-md shadow-sm border-green-200 dark:border-green-800 bg-green-50 dark:bg-green-900 p-2">
            {{ flashSuccess }}
        </div> -->

        <div style="margin-top: 30px">
            <slot></slot>
        </div>
    </main>
</template>

<script setup>
import { Link, usePage } from "@inertiajs/vue3";
import { ref, computed } from "vue";

// page.props.flash.success
const page = usePage();

const flashSuccess = computed(() => page.props.flash.success);
const user = computed(() => page.props.user);
</script>
