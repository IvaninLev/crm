<script setup>
import { Link, usePage } from '@inertiajs/vue3'
import { ref } from 'vue'
import DashboardLayout from '../../Layouts/DashboardLayout.vue'
import UsersLayout from '../../Layouts/UsersLayout.vue'
import { route } from 'ziggy-js'

const props = usePage().props.value ?? usePage().props
const users = ref(props.users?.data ?? props.users ?? [])
</script>

 <template>
    <dashboard-layout page-title="Users">
        <UsersLayout>
            <div class="p-8">
                <Link
                    as="button"
                    class="text-white rounded-md h-8 mb-3 w-24 bg-blue-700 cursor-pointer"
                    :href="route('users.create')"
                >
                    Create user
                </Link>

                <div class="mb-6">
                    <div class="grid grid-cols-4 gap-4 bg-gray-100 p-4 rounded-lg">
                        <div class="font-medium">Id</div>
                        <div class="font-medium">Name</div>
                        <div class="font-medium">Email</div>
                        <div class="font-medium">Actions</div>
                    </div>
                </div>

                <div class="space-y-2">
                    <div
                        v-for="user in users"
                        :key="user.id"
                        class="grid grid-cols-4 gap-4 items-center bg-white p-4 rounded-lg border border-gray-200"
                    >
                        <div class="font-medium">{{ user.id }}</div>
                        <div>{{ user.name }}</div>
                        <div>{{ user.email }}</div>
                        <div class="text-right">
                            <Link
                                :href="route('users.edit', { id: user.id })"
                                class="text-blue-600 hover:text-blue-800 pr-2"
                            >
                                Edit
                            </Link>
                            <Link
                                :href="route('users.show', { id: user.id })"
                                class="text-blue-600 hover:text-blue-800 pr-2"
                            >
                                View
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </UsersLayout>
    </dashboard-layout>
</template>

<style scoped>
</style>
