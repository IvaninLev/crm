<script setup>
import {Link, router, usePage} from "@inertiajs/vue3"
import {route} from "ziggy-js";

defineProps({
    pageTitle: {
        type: String,
        required: true
    }
})
const {auth} = usePage().props

function logout() {
    router.post(route('logout'));
}
</script>

<template>
    <div class="flex min-h-screen ">
        <!-- сайдбар -->
        <aside class="w-[400px] border-r border-gray-200 bg-white fixed h-full">
            <div class="p-8">
                <img src="/img/logo.svg" class="mb-8 h-10">
                <ul class="space-y-6">
                    <li class="space-y-2">
                        <Link href="/" class="block text-lg font-medium text-gray-900">Dashboard</Link>
                    </li>
                    <li>
                        <Link :href="route('profile')" class="text-gray-600 hover:text-gray-900">- Profile</Link>
                    </li>

                    <li>
                        <Link :href="route('tasks.index')" class="text-gray-600 hover:text-gray-900">- Tasks</Link>
                    </li>
                    <li>
                        <Link :href="route('users.index')" class="text-gray-600 hover:text-gray-900">- Users</Link>
                    </li>
                </ul>
            </div>
        </aside>

        <main class="flex-1 ml-[400px]">
            <!-- хедер -->
            <header class="h-[80px] flex items-center justify-between px-8 border-b border-gray-200 bg-white">
                <h1 class="text-2xl font-bold">{{ pageTitle }}</h1>
                <div class="flex items-center gap-4">
                    <div class="text-right">
                        <p class="font-medium">Hi, {{ auth.user.name }}</p>
                        <button
                            @click="logout"
                            type="button"
                            class="text-sm text-[#F03D3D] hover:underline"
                        >
                            Logout
                        </button>
                    </div>
                    <div class="w-10 h-10 bg-gray-300 rounded-full"></div>
                </div>
            </header>
            <slot/>
        </main>
    </div>
</template>
