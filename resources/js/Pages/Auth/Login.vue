<script setup>
import {reactive, ref} from "vue"
import AuthLayout from "../../Layouts/AuthLayout.vue";
import AuthService from "../../services /AuthService.js";
import {router} from "@inertiajs/vue3";
import {route} from "ziggy-js";

const props = defineProps({
    mode: String,
})
const form = reactive({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    remember: false
})
const login = async () => {
     await AuthService.login(form)
        .then(response => {
            router.visit(route('home'))
        })
}

const register = async () => {
    await AuthService.register(form)
        .then(response => {
            router.visit(route('home'))
        })
}

const errors = ref({})

const mode = ref(props.mode)
</script>

<template>
    <AuthLayout>
        <template #link>
            <span class="text-gray-500">You dont have an account?</span>
            <a
                v-if="mode === 'register'"
                @click="mode = 'login'"
                class="ml-2 text-[#60AEA8] font-medium hover:underline cursor-pointer"
            >
                Login
            </a>

            <a
                v-else
                @click="mode = 'register'"
                class="ml-2 text-[#60AEA8] font-medium hover:underline cursor-pointer"
            >
                Register
            </a>


        </template>
        <div class="w-full space-y-6">
            <div v-if="mode === 'register'">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                <input
                    v-model="form.name"
                    type="text"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#60AEA8] focus:border-[#60AEA8] outline-none transition"
                    placeholder="Enter your name">
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">E-mail</label>
                <input
                    v-model="form.email"
                    type="email"
                    id="email"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#60AEA8] focus:border-[#60AEA8] outline-none transition"
                    placeholder="Enter your email"
                >
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input
                    v-model="form.password"
                    type="password"
                    class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-[#60AEA8]"
                    :class="errors.password ? 'border-red-500' : 'border-gray-300'"
                    placeholder="Enter your password"
                />
                <p v-if="errors.password" class="mt-1 text-sm text-red-600">
                    {{ errors.password[0] }}
                </p>
            </div>

            <div v-if="mode === 'register'">
                <label class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                <input
                    v-model="form.password_confirmation"
                    type="password"
                    class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-[#60AEA8]"
                    :class="errors.password_confirmation ? 'border-red-500' : 'border-gray-300'"
                    placeholder="Repeat your password"
                />
                <p v-if="errors.password_confirmation" class="mt-1 text-sm text-red-600">
                    {{ errors.password_confirmation[0] }}
                </p>
            </div>

            <button
                v-if="mode === 'register'"
                @click="register"
                class="w-full bg-[#60AEA8] text-white py-3 px-4 rounded-lg font-medium hover:bg-[#4d9c96] transition focus:outline-none focus:ring-2 focus:ring-[#60AEA8] focus:ring-opacity-50"
            >
                Register
            </button>
            <button
                v-else
                class="w-full bg-[#60AEA8] text-white py-3 px-4 rounded-lg font-medium hover:bg-[#4d9c96] transition focus:outline-none focus:ring-2 focus:ring-[#60AEA8] focus:ring-opacity-50"
                @click="login"
            >
                Login
            </button>
            <div class="flex justify-between">
                <label>
                    <input v-model="form.remember" type="checkbox" class="mx-3">
                    <span class="text-[#B6BCC9]">Remember me</span>
                </label>
                <span class="text-[#6BC2BB]">Forgot Password?</span>
            </div>
        </div>
    </AuthLayout>
</template>

<style scoped>

</style>
