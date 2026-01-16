<script setup lang="ts">
import ViewLayout from "../../Layouts/ViewLayout.vue";
import {Link, usePage} from "@inertiajs/vue3";
import {ref} from "vue";
import {route} from "ziggy-js";

const props = usePage().props
const task = ref(props.task.data || [])
</script>

<template>
    <ViewLayout page-title="Task View">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-800">{{ task.name }}</h1>
                <div class="text-sm text-gray-500 mt-1">
                    Created: {{ task.created }}
                </div>
            </div>

            <div class="grid grid-cols-1 gap-4 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Description</label>
                    <div class="mt-1 p-3 bg-gray-50 rounded">{{ task.description || 'No description' }}</div>
                </div>

                <div>
                    <label class=" text-sm font-medium text-gray-700">Status</label>
                    <div class=" mt-1 p-3 bg-gray-50 rounded">{{  task.status }}</div>
                </div>
            </div>

            <div class="flex justify-around space-x-3">

                <Link
                    :href="route('tasks.index')"
                    class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300 transition"
                >
                    Back to List
                </Link>
                <Link
                    :href="route('tasks.edit', {id:task.id})"
                    class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300 transition"
                >
                    Edit Task
                </Link>
            </div>
        </div>
    </ViewLayout>
</template>

<style scoped>
</style>
