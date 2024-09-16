<template>
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div
            class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden overflow-x-auto mt-3 md:mt-12 mx-auto max-w-sm px-8 py-6"
        >
            <form @submit.prevent="login">
                <div class="">
                    <div>
                        <label for="email" class="label">Email</label>
                        <input
                            id="email"
                            v-model="form.email"
                            type="text"
                            class="input"
                        />
                        <div class="input-error" v-if="form.errors.email">
                            {{ form.errors.email }}
                        </div>
                    </div>
                    <div class="mt-4">
                        <label for="password" class="label">Password</label>
                        <input
                            id="password"
                            v-model="form.password"
                            type="password"
                            class="input"
                        />
                    </div>
                    <div class="mt-8">
                        <button class="btn-primary w-full" type="submit">
                            Login
                        </button>
                        <div class="mt-2 text-center">
                            <Link
                                :href="route('user-account.create')"
                                class="text-sm text-gray-500"
                            >
                                Need an account? Click here
                            </Link>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import { useForm, Link } from "@inertiajs/vue3";

const form = useForm({
    email: null,
    password: null,
});
const login = () => form.post(route("login.store"));
</script>
