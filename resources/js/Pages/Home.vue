<script setup>
import DashboardLayout from "../Layouts/DashboardLayout.vue";
import {computed, onMounted, ref} from "vue";
import TaskService from "../services /TaskService.js";

const tasks = ref([])


const stats = computed(() => {
    return {
        sending: tasks.value.filter(t=> t.status === 0).length,
        done: tasks.value.filter(t=> t.status === 1).length,
        error: tasks.value.filter(t=> t.status === 2).length,
    }
})

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

onMounted(async () => {
    const response = await TaskService.getTasks()
    tasks.value = response?.data
})
</script>

<template>
    <DashboardLayout page-title="Dashboard">
        <div class="p-8">

            <div class="grid grid-cols-4 gap-6 mb-8">
                <div class="bg-white p-6 rounded-lg border border-gray-200 text-center">
                    <div class="text-3xl font-bold text-blue-600">{{stats.sending}}</div>
                    <div class="text-gray-600 mt-2">sends</div>
                </div>
                <div class="bg-white p-6 rounded-lg border border-gray-200 text-center">
                    <div class="text-3xl font-bold text-yellow-500">{{stats.sending}}</div>
                    <div class="text-gray-600 mt-2">in progress</div>
                </div>
                <div class="bg-white p-6 rounded-lg border border-gray-200 text-center">
                    <div class="text-3xl font-bold text-green-500">{{ stats.done}}</div>
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
                    <div class="font-medium">Insights</div>
                </div>
            </div>

            <div class="space-y-2">
                <div v-for="task in tasks" :key="task.id"
                     class="grid grid-cols-4 gap-4 items-center bg-white p-4 rounded-lg border border-gray-200">
                    <div class="font-medium">{{ statusMap(task.status) }}</div>
                    <div>{{ task.name }}</div>
                    <div>{{task.created}}</div>
                    <div class="text-right">
                        <a href="#" class="text-blue-600 hover:text-blue-800">View Insights</a>
                    </div>
                </div>


            </div>
        </div>
    </DashboardLayout>
</template>

<style scoped>

</style>
