<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { flashToast } from "@/Utils/alert";
import { Head, Link } from "@inertiajs/vue3";
import { router } from "@inertiajs/vue3";
import { onMounted } from "vue";
import Swal from "sweetalert2";

defineProps({
    data: {
        type: Object,
    },
});

const goToPage = (url) => {
    if (url) {
        router.get(url);
    }
};

const getPageFromUrl = (url) => {
    if (!url) return null;
    const urlParams = new URLSearchParams(url.split("?")[1]);
    return urlParams.get("page");
};

const deleteUser = (id) => {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        if (result.isConfirmed) {
            router.delete(route("users.destroy", id), {
                onFinish: () => {
                    flashToast()
                }
            });
        }
    });
};
</script>

<template>
    <Head title="Users" />
    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between shrink-0">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    Users
                </h2>
                <Link
                    :href="route('users.create')"
                    class="bg-green-700 text-white rounded-md px-4 py-1"
                    >Create New</Link
                >
            </div>
        </template>

        <div class="py-4">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="overflow-x-auto">
                        <table
                            class="w-full text-sm text-left text-gray-500 dark:text-gray-400"
                        >
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                            >
                                <tr>
                                    <th scope="col" class="px-4 py-3">User</th>
                                    <th scope="col" class="px-4 py-3">Role</th>
                                    <th scope="col" class="px-4 py-3">Email</th>
                                    <th scope="col" class="px-4 py-3">
                                        Date Added
                                    </th>
                                    <th
                                        scope="col"
                                        class="px-4 py-3 text-end"
                                    ></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(item, index) in data.data"
                                    :key="index"
                                    class="border-b dark:border-gray-700"
                                >
                                    <th
                                        scope="row"
                                        class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                                    >
                                        {{ item.name }}
                                    </th>
                                    <td class="px-4 py-3">{{ item.role }}</td>
                                    <td class="px-4 py-3">{{ item.email }}</td>
                                    <td class="px-4 py-3">
                                        {{ item.created_at }}
                                    </td>
                                    <td
                                        class="px-4 py-3 flex items-center justify-end gap-1"
                                    >
                                        <Link
                                            :href="route('users.edit', item.id)"
                                            class="bg-blue-700 text-white px-3 py-1 rounded-md"
                                        >
                                            Edit
                                        </Link>
                                        <button
                                            @click="deleteUser(item.id)"
                                            class="bg-red-700 text-white px-3 py-1 rounded-md"
                                        >
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <nav
                        class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4"
                        aria-label="Table navigation"
                    >
                        <span
                            class="text-sm font-normal text-gray-500 dark:text-gray-400"
                        >
                            Showing
                            <span
                                class="font-semibold text-gray-900 dark:text-white"
                                >{{ data.from }}-{{ data.to }}</span
                            >
                            of
                            <span
                                class="font-semibold text-gray-900 dark:text-white"
                                >{{ data.total }}</span
                            >
                        </span>
                        <ul class="inline-flex items-stretch -space-x-px">
                            <li>
                                <button
                                    @click="goToPage(data.prev_page_url)"
                                    :disabled="!data.prev_page_url"
                                    :class="[
                                        'flex items-center justify-center h-full py-1.5 px-3 ml-0 text-gray-500 bg-white rounded-l-lg border border-gray-300 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400',
                                        data.prev_page_url
                                            ? 'hover:bg-gray-100 hover:text-gray-700 dark:hover:bg-gray-700 dark:hover:text-white cursor-pointer'
                                            : 'opacity-50 cursor-not-allowed',
                                    ]"
                                >
                                    <span class="sr-only">Previous</span>
                                    <svg
                                        class="w-5 h-5"
                                        aria-hidden="true"
                                        fill="currentColor"
                                        viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            fill-rule="evenodd"
                                            d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                            clip-rule="evenodd"
                                        />
                                    </svg>
                                </button>
                            </li>

                            <li
                                v-for="(link, index) in data.links"
                                :key="index"
                            >
                                <button
                                    v-if="
                                        link.label !== '&laquo; Previous' &&
                                        link.label !== 'Next &raquo;'
                                    "
                                    @click="goToPage(link.url)"
                                    :disabled="!link.url || link.active"
                                    :class="[
                                        'flex items-center justify-center text-sm py-2 px-3 leading-tight border border-gray-300 dark:border-gray-700',
                                        link.active
                                            ? 'z-10 text-blue-600 bg-blue-50 border-blue-300 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white'
                                            : 'text-gray-500 bg-white hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white cursor-pointer',
                                        !link.url && !link.active
                                            ? 'opacity-50 cursor-not-allowed'
                                            : '',
                                    ]"
                                    v-html="link.label"
                                ></button>
                            </li>

                            <li>
                                <button
                                    @click="goToPage(data.next_page_url)"
                                    :disabled="!data.next_page_url"
                                    :class="[
                                        'flex items-center justify-center h-full py-1.5 px-3 leading-tight text-gray-500 bg-white rounded-r-lg border border-gray-300 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400',
                                        data.next_page_url
                                            ? 'hover:bg-gray-100 hover:text-gray-700 dark:hover:bg-gray-700 dark:hover:text-white cursor-pointer'
                                            : 'opacity-50 cursor-not-allowed',
                                    ]"
                                >
                                    <span class="sr-only">Next</span>
                                    <svg
                                        class="w-5 h-5"
                                        aria-hidden="true"
                                        fill="currentColor"
                                        viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            fill-rule="evenodd"
                                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                            clip-rule="evenodd"
                                        />
                                    </svg>
                                </button>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
