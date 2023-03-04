<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, Link, useForm} from '@inertiajs/vue3';
import DangerButton from '@/Components/DangerButton.vue';
import {TailwindPagination} from 'laravel-vue-pagination';

const props = defineProps({
    users: Object
});


import { ref } from 'vue';
const usersData = ref({});

const form = useForm({user: []});
usersData.value = props.users;
const getResults = async (page1 = 1) => {
    const response = await fetch(`http://127.0.0.1:8000/users-to-json?page=${page1}`);
    usersData.value = await response.json();
}
const deleteUser = (user) => {
    form.delete(route('users.destroy', {user: user}), {
        onSuccess: () => {
            usersData.value = props.users;
        }
    });
}
</script>
<template>

    <Head title="Users"/>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Users</h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <Link class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                      :href="route('users.create')">
                    Add User
                </Link>
                <div class="overflow-hidden rounded-lg border border-gray-200 shadow-md m-5">
                    <table class="w-full border-collapse bg-white text-left text-sm text-gray-500">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-6 font-medium text-gray-900">Name</th>
                            <th scope="col" class="px-6 py-6 font-medium text-gray-900">Email</th>
                            <th scope="col" class="px-6 py-6 font-medium text-gray-900">Status</th>
                            <th scope="col" class="px-6 py-6 font-medium text-gray-900">Role</th>
                            <th scope="col" class="px-6 py-6 font-medium text-gray-900"></th>
                        </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100 border-t border-gray-100">

                        <tr class="hover:bg-gray-50" v-for="result in usersData.data">
                            <td class=" gap-3 px-6 py-6 font-normal text-gray-900">
                                {{ result.name }}
                            </td>
                            <td class="flex gap-3 px-6 py-6 font-normal text-gray-900">
                                {{ result.email }}
                            </td>
                            <td class="px-6 py-6">
          <span
              class="inline-flex items-center gap-1 rounded-full bg-green-50 px-2 py-1 text-xs font-semibold text-green-600"
          >
            {{ result.status }}

          </span>
                            </td>
                            <td class="px-6 py-6">{{ result.role }}</td>
                            <td class="px-6 py-6">
                                <div class="flex justify-end gap-4">
                                    <Link class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                        :href="route('users.edit', {'user': result} )">
                                        Edit
                                    </Link>
                                    <form method="post" name="deleteUser">
                                            <Link v-model="form.user" @click.stop.prevent="deleteUser(result)">
                                                Delete
                                            </Link>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                    <TailwindPagination
                        :data="usersData"
                        @pagination-change-page="getResults"
                    />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
