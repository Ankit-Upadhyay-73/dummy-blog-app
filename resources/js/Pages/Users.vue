<script setup>
import { Head, Link } from '@inertiajs/vue3';
import User from './User.vue';

import { useUsersStore } from '@/UsersStore';

const us = useUsersStore();

// defineProps({
//     canLogin: {
//         type: Boolean,
//     },
//     canRegister: {
//         type: Boolean,
//     },
//     laravelVersion: {
//         type: String,
//         required: true,
//     },
//     phpVersion: {
//         type: String,
//         required: true,
//     },
// });
</script>

<template>
    <Head title="Users" />

    <div class="antialiased">
        <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
            <div class="max-w-7xl mx-auto p-6 lg:p-8">
                <div class="mt-6 text-md text-gray-900 dark:text-white">
                        List from <code>UsersStore.js</code>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
                        <User v-for="user in us.users" v-bind:key="user.id" :user="user"/>
                    </div>
                <!-- </div> -->
            </div>
        </div>
    </div>                

</template>

<style>
</style>
