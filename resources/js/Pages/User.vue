<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';
import {computed} from 'vue';

const props = defineProps(
    {
        data: Array
    }
);

const results = computed(()=> {
   return props.data.data;
});

</script>
<template>
    <Head title="Users"/>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Users</h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <PrimaryButton class="ml-4">Add User</PrimaryButton>
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

                        <tr class="hover:bg-gray-50" v-for="result in results">
                            <td class=" gap-3 px-6 py-6 font-normal text-gray-900">
                                {{result.name}}
                            </td>
                            <td class="flex gap-3 px-6 py-6 font-normal text-gray-900">
                                {{result.email}}
                            </td>
                            <td class="px-6 py-6">
          <span
              class="inline-flex items-center gap-1 rounded-full bg-green-50 px-2 py-1 text-xs font-semibold text-green-600"
          >
            {{result.status}}

          </span>
                            </td>
                            <td class="px-6 py-6">{{result.role}}</td>
                            <td class="px-6 py-6">
                                <div class="flex justify-end gap-4">
                                    <PrimaryButton class="ml-2">Edit</PrimaryButton>
                                    <DangerButton class="ml-2">Delete</DangerButton>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    {{results.links}}
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
