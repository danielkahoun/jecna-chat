<script setup lang="ts">
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import AuthLayout from "@/Layouts/AuthLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";
import { defineProps } from "vue";

defineProps<{
    chatRooms: App.Models.ChatRoom[];
    users: App.Models.User[];
}>();

const form = useForm({
    name: "",
    description: "",
    isPublic: true,
    users: [],
});

const submit = () => {
    form.post(route("chats.store"));
};
</script>

<template>
    <Head title="Založit nový chat" />

    <AuthLayout>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="flex flex-col gap-6 p-6">
                        <h1 class="text-2xl font-bold">Založit nový chat</h1>

                        <form @submit.prevent="submit">
                            <div class="flex flex-col gap-5">
                                <div>
                                    <InputLabel for="name" value="Název" />

                                    <TextInput
                                        id="name"
                                        type="text"
                                        class="block w-full mt-1"
                                        v-model="form.name"
                                        required
                                        autofocus
                                        autocomplete="off"
                                    />

                                    <InputError
                                        class="mt-2"
                                        :message="form.errors.name"
                                    />
                                </div>

                                <div>
                                    <InputLabel
                                        for="description"
                                        value="Popis"
                                    />

                                    <TextInput
                                        id="description"
                                        type="text"
                                        class="block w-full mt-1"
                                        v-model="form.description"
                                        required
                                        autocomplete="off"
                                    />

                                    <InputError
                                        class="mt-2"
                                        :message="form.errors.description"
                                    />
                                </div>

                                <div class="flex gap-5">
                                    <div>
                                        <label class="inline-flex items-center">
                                            <input
                                                type="radio"
                                                name="isPublic"
                                                v-on:change="
                                                    form.isPublic = true;
                                                    form.users = [];
                                                "
                                                :checked="form.isPublic"
                                            />
                                            <span class="ml-2"
                                                >Veřejný chat</span
                                            >
                                        </label>
                                    </div>
                                    <div>
                                        <label class="inline-flex items-center">
                                            <input
                                                type="radio"
                                                name="isPublic"
                                                v-on:change="
                                                    form.isPublic = false
                                                "
                                                :checked="!form.isPublic"
                                            />
                                            <span class="ml-2"
                                                >Soukromý chat (zvolte
                                                uživatele)</span
                                            >
                                        </label>
                                    </div>
                                </div>

                                <div
                                    class="flex flex-col gap-2"
                                    v-if="!form.isPublic"
                                >
                                    <h2 class="text-xl font-bold">
                                        Vyberte uživatele
                                    </h2>

                                    <div class="flex gap-5">
                                        <div
                                            class="flex items-center gap-2"
                                            v-for="user in users"
                                            :key="user.id"
                                        >
                                            <input
                                                type="checkbox"
                                                class="text-indigo-600 border-gray-300 rounded shadow-sm focus:ring-indigo-500"
                                                v-model="form.users"
                                                :value="user.id"
                                                :checked="false"
                                            />
                                            <span>{{ user.username }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <PrimaryButton
                                        :class="{
                                            'opacity-25': form.processing,
                                        }"
                                        :disabled="form.processing"
                                    >
                                        Vytvořit chat
                                    </PrimaryButton>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthLayout>
</template>
