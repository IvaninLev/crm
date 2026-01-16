<script setup >
import DashboardLayout from "../Layouts/DashboardLayout.vue";


</script>

<template>
    <DashboardLayout page-title="Dashboard">
        <div class="p-8">

            <div class="grid grid-cols-4 gap-6 mb-8">
                <div class="bg-white p-6 rounded-lg border border-gray-200 text-center">
                    <div class="text-3xl font-bold text-blue-600">48</div>
                    <div class="text-gray-600 mt-2">sends</div>
                </div>
                <div class="bg-white p-6 rounded-lg border border-gray-200 text-center">
                    <div class="text-3xl font-bold text-yellow-500">11</div>
                    <div class="text-gray-600 mt-2">in progress</div>
                </div>
                <div class="bg-white p-6 rounded-lg border border-gray-200 text-center">
                    <div class="text-3xl font-bold text-green-500">48</div>
                    <div class="text-gray-600 mt-2">done</div>
                </div>
                <div class="bg-white p-6 rounded-lg border border-gray-200 text-center">
                    <div class="text-3xl font-bold text-red-500">5</div>
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
                <div class="grid grid-cols-4 gap-4 items-center bg-white p-4 rounded-lg border border-gray-200">
                    <div class="font-medium">Send</div>
                    <div>Driver monitor and method for monitoring driver</div>
                    <div>01-01-2022</div>
                    <div class="text-right">
                        <a href="#" class="text-blue-600 hover:text-blue-800">View Insights</a>
                    </div>
                </div>

                <div class="grid grid-cols-4 gap-4 items-center bg-white p-4 rounded-lg border border-gray-200">
                    <div class="font-medium text-yellow-500">In progress</div>
                    <div>Encapsulated Fragile Insulation Materials</div>
                    <div>01-01-2022</div>
                    <div class="text-right">
                        <a href="#" class="text-blue-600 hover:text-blue-800">View Insights</a>
                    </div>
                </div>

                <div class="grid grid-cols-4 gap-4 items-center bg-white p-4 rounded-lg border border-gray-200">
                    <div class="font-medium text-green-500">Done</div>
                    <div>Process for preparing organotion compounds</div>
                    <div>01-01-2022</div>
                    <div class="text-right">
                        <a href="#" class="text-blue-600 hover:text-blue-800">View Insights</a>
                    </div>
                </div>

                <div class="grid grid-cols-4 gap-4 items-center bg-white p-4 rounded-lg border border-gray-200">
                    <div class="font-medium text-red-500">Error</div>
                    <div>Footplate Device for vibrating footwear</div>
                    <div>01-01-2022</div>
                    <div class="text-right">
                        <a href="#" class="text-blue-600 hover:text-blue-800">View Insights</a>
                    </div>
                </div>

                <div class="grid grid-cols-4 gap-4 items-center bg-white p-4 rounded-lg border border-gray-200">
                    <div class="font-medium text-green-500">Done</div>
                    <div>Lorem ipsum dolor sit amet consectetur adipisicing elit...</div>
                    <div>01-01-2022</div>
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
