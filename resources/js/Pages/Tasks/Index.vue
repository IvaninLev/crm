<script setup>
import DashboardLayout from "../../Layouts/DashboardLayout.vue";
import {Link, usePage, router} from "@inertiajs/vue3"; // Добавьте router
import {ref} from "vue";
import {route} from "ziggy-js";

const props = usePage().props
const tasks = ref(props.tasks.data || [])
const statusList = ref(props?.statusList || {})
const deletingTask = ref(new Set())

const destroy = (task) => {
    if (confirm(`Are you sure you want to delete "${task.name}"?`)) {
        router.delete(route('tasks.destroy', {id: task.id}), {
            onSuccess: () => {
                tasks.value = tasks.value.filter(t => t.id !== task.id)

            },
            onError: (errors) => {
                alert('Error deleting task')
            }
        })
    }
}
</script>

<template>
    <DashboardLayout page-title="Tasks">
        <div class="p-8">
            <Link as="button" class="text-white rounded-md h-8 mb-3 w-24 bg-blue-700 cursor-pointer"
                  :href="route('tasks.create')">
                Create task
            </Link>

            <div class="mb-6">
                <div class="grid grid-cols-4 gap-4 bg-gray-100 p-4 rounded-lg">
                    <div class="font-medium">Status</div>
                    <div class="font-medium">Title</div>
                    <div class="font-medium">Publish Date</div>
                    <div class="font-medium">Actions</div>
                </div>
            </div>

            <div class="space-y-2">
                <div
                    v-for="task in tasks"
                    :key="task.id"
                    class="grid grid-cols-4 gap-4  bg-white p-4 rounded-lg border border-gray-200"
                >
                    <div v-if="task.status === 1" class="font-medium text-green-500">
                        <div class=" items-center inline-flex  px-4 py-2 rounded-full bg-green-50 text-green-700  border-[2px] border-green-700">
                            Completed
                        </div>
                    </div>
                    <div v-else-if="task.status === 2" class="font-medium">
                        <div
                            class="inline-flex items-center px-4 py-2 rounded-full bg-red-50 text-red-700 border-[2px] border-red-200">
                            Error
                        </div>
                    </div>
                    <div v-else class="font_medium">
                        <div
                            class="inline-flex items-center px-4 py-2 rounded-full bg-gray-50 text-gray-700 border-[2px] border-gray-200">
                            Send </div>
                    </div>
                    <div class="inline-flex items-center">{{ task.name }}</div>
                    <div class="inline-flex items-center+">{{ task.created }}</div>
                    <div class="inline-flex items-center">
                        <div>
                            {{ statusList.values }}
                        </div>
                        <Link :href="route('tasks.edit', {id:task.id})" class="text-blue-600 hover:text-blue-800 pr-2">
                            Edit
                        </Link>
                        <Link :href="route('tasks.show', {id:task.id})" class="text-blue-600 hover:text-blue-800 pr-2">
                            View
                        </Link>
                        <button
                            @click="destroy(task)"
                            class="text-red-600 hover:text-red-800 pr-2 cursor-pointer"
                        >
                            Delete
                        </button>

                    </div>
                </div>

            </div>
        </div>
    </DashboardLayout>
</template>

<style scoped>

</style>
