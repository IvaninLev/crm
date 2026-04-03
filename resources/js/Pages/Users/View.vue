<script setup>
import ViewLayout from "../../Layouts/ViewLayout.vue";
import { Link, usePage } from "@inertiajs/vue3";
import { ref, computed } from "vue";
import { route } from "ziggy-js";

const pageProps = usePage().props.value ?? usePage().props;
const rawUser = pageProps.user?.data ?? pageProps.user ?? null;
const user = ref(rawUser);

const formatDate = (date) =>{
    return date.slice(0,10)
}

const tasks = computed(() => user.value?.tasks ?? []);

const editHref = computed(() => {
    if (!user.value || !user.value.id) return null;
    return route('users.edit', { user: user.value.id });
});
</script>

<template>
    <ViewLayout page-title="User View">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-800">{{ user?.name ?? '—' }}</h1>
                <div class="text-sm text-gray-500 mt-1">
                    Registered: {{ formatDate(user?.created_at) ?? '—' }}
                </div>
            </div>

            <div class="grid grid-cols-1 gap-4 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <div class="mt-1 p-3 bg-gray-50 rounded">{{ user?.email ?? '—' }}</div>
                </div>
            </div>

            <div class="mb-6">
                <div class="flex items-center justify-between mb-2">
                    <h2 class="text-lg font-semibold text-gray-800">Tasks</h2>
                    <span class="text-sm text-gray-500">{{ tasks.length }} total</span>
                </div>

                <div v-if="tasks.length" class="space-y-2">
                    <div v-for="task in tasks" :key="task.id" class="border rounded p-3 bg-gray-50">
                        <div class="font-medium text-gray-800">{{ task.name }}</div>
                        <div class="text-sm text-gray-600">{{ task.description }}</div>
                        <div class="text-xs text-gray-500 mt-1">Created: {{ task.created }}</div>
                        <div class="text-xs text-gray-500">Status: {{ task.status }}</div>
                    </div>
                </div>
                <div v-else class="text-gray-500 text-sm">No tasks yet.</div>
            </div>

            <div class="flex justify-around space-x-3">
                <Link :href="route('users.index')" class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300 transition">
                    Back to List
                </Link>

                <Link v-if="editHref" :href="editHref" class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300 transition">
                    Edit User
                </Link>
                <button v-else class="px-4 py-2 bg-gray-100 text-gray-400 rounded" disabled>
                    Edit User
                </button>
            </div>
        </div>
    </ViewLayout>
</template>
