<script setup>
import DashboardLayout from "../../Layouts/DashboardLayout.vue";
import {helpers, minLength, required, requiredIf} from "@vuelidate/validators";
import useVuelidate from "@vuelidate/core";
import {getCurrentInstance, ref} from "vue";
import {useForm, usePage} from "@inertiajs/vue3";

const props = usePage().props.value ?? usePage().props
const user = useForm({
    name: null,
    email: null,
    password: null,
})

const rules = {
    name: {
        required: helpers.withMessage('Name is required', required),
        minLength: helpers.withMessage('Name must contain at least 5 characters', minLength(5))
    },
    email: {
        required: helpers.withMessage('Email is required', required)
    },
    password:{
        requiredIf: helpers.withMessage('Password is required', requiredIf(() => props?.edit || false))
    }
};

const v$ = useVuelidate(rules, user);
const _this = getCurrentInstance()?.proxy;
const submit = async () => {
}
</script>

<template>
    <dashboard-layout page-title="Create">
        <div class="p-8 flex flex-wrap">
            <div class="w-1/2 px-3">
                <label class="block mb-2">Name</label>
                <input
                    type="text"
                    placeholder="Enter name"
                    v-model="user.name"
                    class="border-1 border-gray-300 rounded-md py-1 px-3 w-full"
                    @blur="v$.name.$touch()"
                >
                <div class="text-xs text-red-700 my-2 h-5">
                    <span v-if="v$.name.required.$invalid && v$.name.$dirty">{{ v$.name.required.$message }}</span>
                    <span v-if="v$.name.minLength.$invalid && v$.name.$dirty">{{ v$.name.minLength.$message }}</span>
                </div>
            </div>

            <div class="w-full px-3">
                <label class="block mb-2">Email</label>
                <input
                    type="email"
                    class="border-1 border-gray-300 rounded-md py-1 px-3 w-full"
                    placeholder="Enter email"
                    v-model="user.email"
                    @blur="v$.email.$touch()"
                ></input>
                <div class="text-xs text-red-700 my-2 h-5">
                    <span v-if="v$.email.required.$invalid && v$.email.$dirty">
                        {{ v$.email.required.$message }}
                    </span>
                </div>
            </div>

            <div class="w-full px-3">
                <label class="block mb-2">Password</label>
                <input
                    v-model="user.password"
                    type="password"
                    placeholder="Enter password"
                    class="border-1 border-gray-300 rounded-md py-1 px-3 w-full"
                    @blur="v$.password.$touch()"
                >
                <div class="text-xs text-red-700 my-2 h-5">
                    <!-- <span v-if="v$.password.required.$invalid && v$.password.$dirty"> -->
                    <!--   {{ v$.password.required.$message }} -->
                 <!--  </span> -->
              </div>
          </div>

          <div class="w-full px-3">
              <button
                  class="w-full py-2 px-4 bg-blue-500 text-white rounded hover:bg-blue-600"
                  @click="submit"
              >
                  <span>{{ props.edit ? 'Update' : 'Create' }}</span>
              </button>
          </div>
      </div>
  </dashboard-layout>
</template>

<style scoped></style>
