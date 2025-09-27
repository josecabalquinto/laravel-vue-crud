<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { flashToast } from "@/Utils/alert";
import { Head, router, useForm } from "@inertiajs/vue3";
import { computed, ref } from "vue";

const props = defineProps({
    data: {
        type: Object,
        default: () => ({}),
    },
    errors: {
        type: Object,
        default: () => ({}),
    },
});

const showPassword = ref(false);
const togglePasswordVisibility = () => {
    showPassword.value = !showPassword.value;
};

const form = useForm({
    name: props.data?.name || "",
    role: props.data?.role || "",
    email: props.data?.email || "",
    password: props.data?.password || "",
});

const isEditing = computed(() => props.data && props.data.id);

const submit = () => {
    if (isEditing.value) {
        form.put(`/users/${props.data.id}`, {
            onFinish: () => {
                flashToast()
            }
        });
    } else {
        form.post(route("users.store"), {
            onFinish: () => {
                flashToast()
            }
        });
    }
};

const cancel = () => {
    router.get(route("users.index"));
};
</script>

<template>
    <Head title="User Data Form" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ isEditing ? "Edit User" : "Create New User" }}
            </h2>
        </template>

        <div class="py-4">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <section class="bg-white dark:bg-gray-900">
                        <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
                            <h2
                                class="mb-4 text-xl font-bold text-gray-900 dark:text-white"
                            >
                                {{
                                    isEditing
                                        ? "Update User Information"
                                        : "Add a New User"
                                }}
                            </h2>

                            <form @submit.prevent="submit">
                                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                                    <!-- Name Field -->
                                    <div class="sm:col-span-2">
                                        <label
                                            for="name"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                        >
                                            Full Name
                                        </label>
                                        <input
                                            v-model="form.name"
                                            type="text"
                                            name="name"
                                            id="name"
                                            :class="[
                                                'bg-gray-50 border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
                                                errors.name || form.errors.name
                                                    ? 'border-red-500'
                                                    : 'border-gray-300',
                                            ]"
                                            placeholder="Enter full name"
                                            required
                                        />
                                        <div
                                            v-if="
                                                errors.name || form.errors.name
                                            "
                                            class="mt-1 text-sm text-red-600"
                                        >
                                            {{
                                                errors.name || form.errors.name
                                            }}
                                        </div>
                                    </div>

                                    <!-- Email Field -->
                                    <div class="sm:col-span-2">
                                        <label
                                            for="email"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                        >
                                            Email Address
                                        </label>
                                        <input
                                            v-model="form.email"
                                            type="email"
                                            name="email"
                                            id="email"
                                            :class="[
                                                'bg-gray-50 border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
                                                errors.email ||
                                                form.errors.email
                                                    ? 'border-red-500'
                                                    : 'border-gray-300',
                                            ]"
                                            placeholder="user@example.com"
                                            required
                                        />
                                        <div
                                            v-if="
                                                errors.email ||
                                                form.errors.email
                                            "
                                            class="mt-1 text-sm text-red-600"
                                        >
                                            {{
                                                errors.email ||
                                                form.errors.email
                                            }}
                                        </div>
                                    </div>

                                    <!-- Password Field -->
                                    <div class="sm:col-span-2">
                                        <label
                                            for="password"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                        >
                                            Password
                                            <span
                                                v-if="isEditing"
                                                class="text-gray-500 font-normal"
                                            >
                                                (leave blank to keep current)
                                            </span>
                                        </label>
                                        <div class="relative">
                                            <input
                                                v-model="form.password"
                                                :type="
                                                    showPassword
                                                        ? 'text'
                                                        : 'password'
                                                "
                                                name="password"
                                                id="password"
                                                :class="[
                                                    'bg-gray-50 border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 pr-10 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
                                                    errors.password ||
                                                    form.errors.password
                                                        ? 'border-red-500'
                                                        : 'border-gray-300',
                                                ]"
                                                placeholder="Enter password"
                                                :required="!isEditing"
                                            />
                                            <button
                                                type="button"
                                                @click="
                                                    togglePasswordVisibility
                                                "
                                                class="absolute inset-y-0 right-0 pr-3 flex items-center"
                                            >
                                                <svg
                                                    v-if="showPassword"
                                                    class="w-5 h-5 text-gray-400"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    viewBox="0 0 24 24"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"
                                                    ></path>
                                                </svg>
                                                <svg
                                                    v-else
                                                    class="w-5 h-5 text-gray-400"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    viewBox="0 0 24 24"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                                    ></path>
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                                                    ></path>
                                                </svg>
                                            </button>
                                        </div>
                                        <div
                                            v-if="
                                                errors.password ||
                                                form.errors.password
                                            "
                                            class="mt-1 text-sm text-red-600"
                                        >
                                            {{
                                                errors.password ||
                                                form.errors.password
                                            }}
                                        </div>
                                    </div>

                                    <!-- Role Field -->
                                    <div class="sm:col-span-2">
                                        <label
                                            for="role"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                        >
                                            User Role
                                        </label>
                                        <select
                                            v-model="form.role"
                                            id="role"
                                            name="role"
                                            :class="[
                                                'bg-gray-50 border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
                                                errors.role || form.errors.role
                                                    ? 'border-red-500'
                                                    : 'border-gray-300',
                                            ]"
                                            required
                                        >
                                            <option value="user">User</option>
                                            <option value="admin">Admin</option>
                                        </select>
                                        <div
                                            v-if="
                                                errors.role || form.errors.role
                                            "
                                            class="mt-1 text-sm text-red-600"
                                        >
                                            {{
                                                errors.role || form.errors.role
                                            }}
                                        </div>
                                    </div>
                                </div>

                                <!-- Form Actions -->
                                <div class="flex items-center gap-4 mt-6">
                                    <button
                                        type="submit"
                                        :disabled="form.processing"
                                        :class="[
                                            'inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 transition-colors',
                                            form.processing
                                                ? 'bg-gray-400 cursor-not-allowed'
                                                : 'bg-blue-700 hover:bg-blue-800',
                                        ]"
                                    >
                                        <svg
                                            v-if="form.processing"
                                            class="w-4 h-4 mr-2 animate-spin"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                        >
                                            <circle
                                                class="opacity-25"
                                                cx="12"
                                                cy="12"
                                                r="10"
                                                stroke="currentColor"
                                                stroke-width="4"
                                            ></circle>
                                            <path
                                                class="opacity-75"
                                                fill="currentColor"
                                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                                            ></path>
                                        </svg>
                                        {{
                                            form.processing
                                                ? "Processing..."
                                                : isEditing
                                                ? "Update User"
                                                : "Create User"
                                        }}
                                    </button>

                                    <button
                                        type="button"
                                        @click="cancel"
                                        :disabled="form.processing"
                                        class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 transition-colors"
                                    >
                                        Cancel
                                    </button>
                                </div>

                                <!-- Display general form errors -->
                                <div
                                    v-if="Object.keys(form.errors).length > 0"
                                    class="mt-4 p-4 bg-red-50 rounded-lg"
                                >
                                    <h3
                                        class="text-sm font-medium text-red-800"
                                    >
                                        Please correct the following errors:
                                    </h3>
                                    <ul
                                        class="mt-2 text-sm text-red-700 list-disc list-inside"
                                    >
                                        <li
                                            v-for="(
                                                error, field
                                            ) in form.errors"
                                            :key="field"
                                        >
                                            {{ error }}
                                        </li>
                                    </ul>
                                </div>
                            </form>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
