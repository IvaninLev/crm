<script setup>
import {router, usePage} from "@inertiajs/vue3";
import {computed, ref} from "vue";
import {route} from "ziggy-js";

const emit = defineEmits(['close', 'apply', 'clear'])

const pageProps = usePage().props.value ?? usePage().props;

const rawUser = pageProps.user?.data ?? pageProps.user ?? null;

const user = ref(rawUser);

const editHref = computed(() => {
    if (!user.value || !user.value.id) return null;
    return route('users.edit', { user: user.value.id });
});
</script>

<template>
    <div class="p-8 max-w-xl mx-auto bg-white rounded shadow">
        <button @click="router.visit(route('home'))">close</button>
        <h1 class="text-2xl font-bold mb-4">My Profile</h1>


        <div class="space-y-4">
            <div>
                <label class="font-medium">Name</label>
                <div class="p-2 bg-gray-100 rounded">{{ user?.name }}</div>
            </div>

            <div>
                <label class="font-medium">Email</label>
                <div class="p-2 bg-gray-100 rounded">{{ user?.email }}</div>
            </div>

            <div>
                <label class="font-medium">Registered</label>
                <div class="p-2 bg-gray-100 rounded">{{ user?.created}}</div>
            </div>
        </div>
    </div>
</template>
