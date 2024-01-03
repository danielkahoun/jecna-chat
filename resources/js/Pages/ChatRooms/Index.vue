<script setup lang="ts">
import ChatroomCard from "@/Components/ChatroomCard.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import AuthLayout from "@/Layouts/AuthLayout.vue";
import { Head, Link } from "@inertiajs/vue3";

defineProps<{
    chatRooms: App.Models.ChatRoom[];
}>();
</script>

<template>
    <Head title="Moje chaty" />

    <AuthLayout>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="flex flex-col gap-6 p-6">
                        <div class="flex justify-between">
                            <h1 class="text-2xl font-bold">Moje chaty</h1>
                            <Link :href="route('chats.create')"
                                ><PrimaryButton>Nový chat</PrimaryButton></Link
                            >
                        </div>

                        <template
                            v-for="chatroom in chatRooms"
                            :key="chatroom.id"
                        >
                            <Link :href="route('chats.show', chatroom.id)">
                                <ChatroomCard
                                    :name="chatroom.name"
                                    :description="chatroom.description"
                                ></ChatroomCard>
                            </Link>
                        </template>

                        <p v-if="chatRooms.length == 0">
                            Nebyl nalezen žádný chat.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </AuthLayout>
</template>
