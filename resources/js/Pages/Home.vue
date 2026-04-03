<script setup>
import DashboardLayout from "../Layouts/DashboardLayout.vue";
import {computed, ref} from "vue";
import TaskService from "../services /TaskService.js";
import {usePage} from "@inertiajs/vue3";

const props = usePage().props
const tasks = ref(props.tasks?.data ?? [])
const meta = ref(props.meta ?? {stats: {}, last_page: 1, current_page: 1})
const page = ref(meta.value.current_page ?? 1)

const stats = computed(() => ({
    total: meta.value.total ?? 0,
    sending: meta.value.stats?.sending ?? 0,
    inProgress: meta.value.stats?.sending ?? 0,
    done: meta.value.stats?.done ?? 0,
    error: meta.value.stats?.error ?? 0,
}))

const totalPages = computed(() => Math.max(1, Number(meta.value.last_page ?? 1)))

const loadPage = async (newPage) => {
    const response = await TaskService.getTasksPage(newPage)
    tasks.value = response?.data ?? []

    const nextMeta = response?.meta ?? {}
    meta.value = {
        ...meta.value,
        ...nextMeta,
        stats: nextMeta.stats ?? meta.value.stats ?? {},
    }

    page.value = meta.value.current_page ?? newPage
}

const nextPage = async () => {
    if (page.value < totalPages.value) {
        await loadPage(page.value + 1)
    }
}
const prevPage = async () => {
    if (page.value > 1) {
        await loadPage(page.value - 1)
    }
}
const statusMap = (sts) => {
    if (sts === null || sts === undefined) return ''

    const statusMap = {
        send: 0,
        completed: 1,
        error: 2,
    }
    const status = Object.keys(statusMap).find(key => statusMap[key] === sts)

    return status || ''
}

</script>

<template>
    <DashboardLayout page-title="Dashboard">
        <div class="p-8">

            <div class="grid grid-cols-4 gap-6 mb-8">
                <div class="bg-white p-6 rounded-lg border border-gray-200 text-center">
                    <div class="text-3xl font-bold text-blue-600">{{ stats.total }}</div>
                    <div class="text-gray-600 mt-2">sends</div>
                </div>
                <div class="bg-white p-6 rounded-lg border border-gray-200 text-center">
                    <div class="text-3xl font-bold text-yellow-500">{{ stats.inProgress }}</div>
                    <div class="text-gray-600 mt-2">in progress</div>
                </div>
                <div class="bg-white p-6 rounded-lg border border-gray-200 text-center">
                    <div class="text-3xl font-bold text-green-500">{{ stats.done }}</div>
                    <div class="text-gray-600 mt-2">done</div>
                </div>
                <div class="bg-white p-6 rounded-lg border border-gray-200 text-center">
                    <div class="text-3xl font-bold text-red-500">{{ stats.error }}</div>
                    <div class="text-gray-600 mt-2">errors</div>
                </div>
            </div>

            <div class="mb-6">
                <h2 class="text-xl font-semibold mb-4">Status</h2>
                <div class="grid grid-cols-4 gap-4 bg-gray-100 p-4 rounded-lg">
                    <div class="font-medium">Status</div>
                    <div class="font-medium">Title</div>
                    <div class="font-medium">Publish Date</div>
                </div>
            </div>

            <div class="space-y-2">
                <div v-for="task in tasks" :key="task.id"
                     class="grid grid-cols-4 gap-4 items-center bg-white p-4 rounded-lg border border-gray-200">
                    <div class="font-medium">{{ statusMap(task.status) }}</div>
                    <div>{{ task.name }}</div>
                    <div>{{ task.created }}</div>
                </div>
                <div class="flex d-flex justify-center">
                    <button class="px-3 py-1 border rounded mr-2" :disabled="page === 1" @click="prevPage">Prev</button>
                    <div class="px-2">Page {{ page }} / {{ totalPages }}</div>
                    <button class="px-3 py-1 border rounded ml-2" :disabled="page === totalPages" @click="nextPage">Next</button>
                </div>

            </div>
        </div>
    </DashboardLayout>
</template>

<style scoped>

</style>
