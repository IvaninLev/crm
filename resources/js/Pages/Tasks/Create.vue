<script setup>
import DashboardLayout from "../../Layouts/DashboardLayout.vue";
import {router, usePage} from "@inertiajs/vue3";
import TaskService from "../../services /TaskService.js";
import {getCurrentInstance, ref} from "vue";
import useVuelidate from "@vuelidate/core";
import {required, helpers, minLength, requiredIf} from "@vuelidate/validators";

const props = usePage().props;
const task = ref(props?.task?.data || {});
const statusList = ref(props?.statusList || {});
const users = ref(props.users ?? []);
const submitting = ref(false);
const formTouched = ref(false);

const rules = {
    name: {
        required: helpers.withMessage('Name is required', required),
        minLength: helpers.withMessage('Name must be at least 5 characters', minLength(5))
    },
    description: {
        required: helpers.withMessage('Description is required', required)
    },
    status: {
        requiredIf: helpers.withMessage('Status is required', requiredIf(() => props?.edit || false))
    }
};

const v$ = useVuelidate(rules, task);

const pageTitle = ref(props.edit ? 'Edit Task' : 'Create New Task');
const _this = getCurrentInstance().proxy


const submit = async () => {
    formTouched.value = true;

    if (submitting.value) return;

    const isValid = await v$.value.$validate();
    if (!isValid) return;

    submitting.value = true;

    try {
        if (task.value.id) {
            await TaskService.update(task.value);
            _this.$toast.success('Задача успешно обновлена', {
                "theme": "colored",
                "autoClose": 3000,
            })
        } else {
            await TaskService.create(task.value);
            _this.$toast.success('Задача успешно создана', {
                "theme": "colored",
                "autoClose": 3000,
            })


        }

        setTimeout(() => {
            router.visit(route('tasks.index'));
        }, 800);

    } catch (error) {
        submitting.value = false;
        showToast('Something went wrong', 'error');
    }
};

const resetForm = () => {
    task.value = {};
    v$.value.$reset();
    formTouched.value = false;
};

const cancel = () => {
    router.visit(route('tasks.index'));
};
</script>

<template>
    <DashboardLayout :page-title="pageTitle">
        <div class="min-h-screen bg-gray-50 py-8 px-4">
            <div class="max-w-3xl mx-auto">
                <!-- Header -->
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">
                        {{ pageTitle }}
                    </h1>
                    <p class="text-gray-600">
                        {{ props.edit ? 'Update your task details' : 'Fill in the details to create a new task' }}
                    </p>
                </div>

                <!-- Form -->
                <div class="bg-white rounded-xl shadow p-6">
                    <!-- Name Field -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Task Name *
                        </label>
                        <input
                            type="text"
                            v-model="task.name"
                            placeholder="Enter task name"
                            :class="{
                                'border-red-500': v$.name.$invalid && formTouched,
                                'border-green-500': task.name && !v$.name.$invalid
                            }"
                            class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            @blur="v$.name.$touch()"
                        />
                        <div v-if="v$.name.$invalid && formTouched" class="mt-1 text-sm text-red-600">
                            {{ v$.name.$errors[0]?.$message }}
                        </div>
                    </div>

                    <!-- Status/User Field -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <!-- Status Field -->
                        <div v-if="Object.keys(statusList).length">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Status *
                            </label>
                            <select
                                v-model="task.status"
                                :class="{
                                    'border-red-500': v$.status.$invalid && formTouched
                                }"
                                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            >
                                <option value="" disabled>Select status</option>
                                <option v-for="(status, index) in statusList"
                                        :key="index"
                                        :value="index">
                                    {{ status }}
                                </option>
                            </select>
                            <div v-if="v$.status.$invalid && formTouched" class="mt-1 text-sm text-red-600">
                                {{ v$.status.$errors[0]?.$message }}
                            </div>
                        </div>

                        <!-- User Field -->
                        <div v-else>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Assign To
                            </label>
                            <select
                                v-model="task.user_id"
                                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            >
                                <option value="" disabled>Select a user</option>
                                <option v-for="user in users"
                                        :key="user.id"
                                        :value="user.id">
                                    {{ user.name }}
                                </option>
                            </select>
                        </div>
                    </div>

                    <!-- Description Field -->
                    <div class="mb-8">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Description *
                        </label>
                        <textarea
                            v-model="task.description"
                            rows="4"
                            placeholder="Enter task description"
                            :class="{
                                'border-red-500': v$.description.$invalid && formTouched,
                                'border-green-500': task.description && !v$.description.$invalid
                            }"
                            class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none"
                            @blur="v$.description.$touch()"
                        ></textarea>
                        <div v-if="v$.description.$invalid && formTouched" class="mt-1 text-sm text-red-600">
                            {{ v$.description.$errors[0]?.$message }}
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t">
                        <button
                            @click="submit"
                            :disabled="submitting"
                            class="flex-1 bg-blue-600 text-white font-medium py-3 px-6 rounded-lg hover:bg-blue-700 disabled:opacity-50 disabled:cursor-not-allowed transition-colors"
                        >
                            <div class="flex items-center justify-center">
                                <svg v-if="submitting"
                                     class="animate-spin h-5 w-5 mr-2"
                                     fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                            stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                          d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                <span>
                                    {{ submitting ? 'Processing...' : (props.edit ? 'Update Task' : 'Create Task') }}
                                </span>
                            </div>
                        </button>

                        <button
                            @click="resetForm"
                            type="button"
                            :disabled="submitting"
                            class="flex-1 border border-gray-300 text-gray-700 font-medium py-3 px-6 rounded-lg hover:bg-gray-50 transition-colors"
                        >
                            Reset
                        </button>

                        <button
                            @click="cancel"
                            type="button"
                            :disabled="submitting"
                            class="flex-1 border border-red-300 text-red-600 font-medium py-3 px-6 rounded-lg hover:bg-red-50 transition-colors"
                        >
                            Cancel
                        </button>
                    </div>
                </div>

                <!-- Tips Section -->
                <div class="mt-6 p-4 bg-blue-50 border border-blue-100 rounded-lg">
                    <div class="flex items-start">
                        <svg class="h-5 w-5 text-blue-500 mt-0.5 mr-2" fill="none" stroke="currentColor"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div>
                            <p class="text-sm text-blue-800">
                                <strong>Tip:</strong> Use clear and descriptive names. Provide detailed descriptions for
                                better understanding.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </DashboardLayout>
</template>

<style scoped>
/* Simple animations */
.animate-spin {
    animation: spin 1s linear infinite;
}

@keyframes spin {
    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(360deg);
    }
}
</style>
